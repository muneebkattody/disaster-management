<?php
$title = "Result Generator";
require 'header.php';
echo "</head><body>";

// GET NEEDS FROM NEEDS.CSV FILE
$file = fopen("csv/needs.csv","r");
$needs = fgetcsv($file);
fclose($file);

// GET DATABASE VALUES
require 'config.php';

// 1- FIRST TRY TO GET ALL THE RESOUCES WE HAVE NY PLAYING WITH DONATIONS TABLE
// SET DATABASE NAME
$dbname = "id9965532_camp";

// CREATES CONNECTION
$conn = new mysqli($servername, $username, $password, $dbname);
// CHECKING FOR ERROR
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// TRY TO GET ALL AVAILBALE RESOURCES BY SUMMATION ALL DONATIONS
// SET MY SQL STRIING TO SELECT VALUES FROM DONATIONINDI TABLE IN DONATION DB
$sql = "SELECT SUM(food) AS food, SUM(water) AS water, SUM(clothing) AS clothing, SUM(medicine) AS medicine, SUM(cooking) AS cooking, SUM(sanitary) AS sanitary  FROM donationindi";
// QUERY SQL
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    // STORE TOTAL VALUES TO ARRAY AVAIL[] BY CATOGORY USING ASSOSIATIVE ARRAY
    foreach($needs as $el){
    $avail[$el] = $row[$el];
    }
}


// CLOSE MySQL CONNECTION
$conn->close();

// PRINT AVAIL[] FOR TESTING
// print_r($avail);
// echo "<BR>";

// 2- SECOND GET NEEDS FOR EACH CAMP AND THE CATOGORY OF NEEDS
// SET DB NAME
$dbname = "id9965532_camp";

// CREATES CONNECTION
$conn = new mysqli($servername, $username, $password, $dbname);
// CHECKING FOR ERROR
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GETTING NEEDS FOR CAMPS FROM CAMPNEEDS
$sql = "SELECT * FROM campneeds";
$result = $conn->query($sql);
// CHECKING IF THERE ATLEAST ONE ROW IN RESULT
if ($result->num_rows > 0) {
    // CHANGING TO ASSOSIATIVE ARRAY
    while ($row = $result->fetch_assoc()) {
        // GET CAMP NO
        $campno = $row['campno'];
        //STORE VALUES TO NEED DB WITH RESPECT TO CATOGORY AND CAMP NO
        foreach($needs as $el)
        $need[$el][$campno] = $row[$el];
    }
} else { // IF THERE IS NO ROW IN CAMPNEEDS - MEANS THERE IS NO NEED
    echo "THERE IS NO NEED";
}
// NEED TOTAL BASE
$sql = "SELECT SUM(food) AS food, SUM(water) AS water, SUM(clothing) AS clothing, SUM(medicine) AS medicine, SUM(cooking) AS cooking, SUM(sanitary) AS sanitary  FROM campneeds";
// QUERY SQL
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    // STORE TOTAL VALUES TO ARRAY AVAIL[] BY CATOGORY USING ASSOSIATIVE ARRAY
    foreach($needs as $el)
    $total_need[$el] = $row[$el];
}
// CLOSING MySQL CONNECTION
$conn->close();

// PRINTING NEED[] FOR TESTING
// print_r($need);

// PRINTING NEED AND AVAILABLE VALUES
echo "<BR><table class='w3-bordered w3-border'><tr>
    <th>Goods</th><th>Need</th><th>Available</th>
    </tr>";
// PRINT EACH VAUES CORRESPONDINGLY
foreach($needs as $el)
echo "<tr><td>".$el."</td><td>" . $total_need[$el] . "</td><td>" . $avail[$el] . "</td></tr>";

echo "</table>";
// BALENCE OF AVAIL - IF AVAIL > NEED
$balence = [];

// DEVIDE AVAILBALE RESOURCES TO EACH CAMPS NY USING DEVIDER FUNCTION
foreach($needs as $el)
$supply[$el] = devider($avail[$el], $need[$el], $total_need[$el]);


// PRINT SUPPLY ARRAY FOR TESTING
// print_r($supply);
// print_r($balence);

// PUBLISH RESULT AS TABLE
// TABLE LAYOUT CREATING
/*
echo "<table class='w3-bordered w3-border'><tr>
<th>Camp No</th><th>Given</th><th>Need</th><th>Product</th>
</tr>";
// STORE CAMP NUMBERS
$camps = array_keys($need['food']);
foreach ($camps as $key => $cn) {
// PRINT EACH VAUES CORRESPONDINGLY
echo "<tr><td rowspan='6'>" . $cn . "</td><td>" . $supply['food'][$key] . "</td><td>" . $need['food'][$cn] . "</td><td>food</td></tr>";
echo "<tr><td>" . $supply['water'][$key] . "</td><td>" . $need['water'][$cn] . "</td><td>water</td></tr>";
echo "<tr><td>" . $supply['clothing'][$key] . "</td><td>" . $need['clothing'][$cn] . "</td><td>clothing</td></tr>";
echo "<tr><td>" . $supply['medicine'][$key] . "</td><td>" . $need['medicine'][$cn] . "</td><td>medicine</td></tr>";
echo "<tr><td>" . $supply['cooking'][$key] . "</td><td>" . $need['cooking'][$cn] . "</td><td>cooking</td></tr>";
echo "<tr><td>" . $supply['sanitary'][$key] . "</td><td>" . $need['sanitary'][$cn] . "</td><td>sanitary</td></tr>";
}
echo "</table>";
 */

//SETTING TABLE LAYOUT
$layout = "<table class='w3-bordered w3-border'><tr><th>Camp no.</th>";
foreach($needs as $el)
    $layout.="<th>".$el."</th>";
$layout.="</tr>";


// STORE CAMP NUMBERS
$camps = array_keys($need[$needs[0]]);
foreach ($camps as $key => $cn) {
    // STORE EACH VAUES CORRESPONDINGLY
    $layout.="<tr><td rowspan='1'>" . $cn . "</td>";
    foreach($needs as $el){
    $layout.="<td>".$supply[$el][$key];
    }
    $layout.="</tr>";
}
$layout.="</table>";

echo $layout;

//  STORING DATA TO TEMP_RESULT TABLE
$db = 'id9965532_camp';
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
foreach ($camps as $key => $cn) {
    if (row_excist('temp_result', "campno=" . $cn)) {
        $table = "campneeds";
        $where = "campno='" . $cn . "'";
        $update = "food=" . $supply['food'][$key] . ",water=" . $supply['water'][$key] . ",clothing=" . $supply['clothing'][$key] . ",medicine=" . $supply['medicine'][$key] . ",cooking=" . $supply['cooking'][$key] . ",sanitary=" . $supply['sanitary'][$key];
        update_row($table, $where, $update);
    }
    insert_row("temp_result", $cn, $supply['water'][$key], $supply['food'][$key], $supply['clothing'][$key], $supply['medicine'][$key], $supply['cooking'][$key], $supply['sanitary'][$key]);
}

// PRINTING REMINING VALUES
$layout = "REMINING RESOURCES ";
foreach($needs as $key=>$el){
    $layout.="<br> ".$el.":" . ($supply[$el][count($camps)] + $balence[$key]);
}
echo $layout;

// DEVIDER FUNCTION TO DEVIDE AVAILBALE RESOURCE TO CAMP NEEDS
function devider($s, $vars, $total_need)
{
    // IF AVAILBALE IS GREATER THAN NEEDED THEN DEVIDER GIVES GOODS MORE THAN NEEDED TO AVOID THIS
    // ADD THIS TO BALENECE AND SET AVAIL = NEEDED
    global $balence;
    $s = $s;
    if ($s > $total_need) {
        array_push($balence, $s - $total_need);
        $s = $total_need;
    } else {
        array_push($balence, 0);
    }
    $sum = 0;
    $ret_val = [];
    foreach ($vars as $n) {
        $sum += $n;
    }
    foreach ($vars as $n) {
        $v = ($n * 100) / $sum;
        $v = intval(($s * $v) / 100);
        array_push($ret_val, $v);
    }
    // FINDING REMINING RESOURCES
    $sum = 0;
    foreach ($ret_val as $n) {
        $sum += $n;
    }
    // echo $sum . "<BR>";
    $rem = $s - $sum;
    array_push($ret_val, $rem);

    return $ret_val;
}
