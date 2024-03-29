<?php
$title = "Dashboard";
require('header.php');
require 'config.php';
?>
</head>
<body>

<header class="w3-container w3-teal m-btm">
<h1>Disaster Management Software</h1>
<h6>Powerd by AardWolf &reg;</h6>
</header>

<?php

$db = 'id9965532_camp';

// GETTING STATISTIVS OF MISSING PERSON

// MISSING PERSON MALE
$male = get_data('COUNT(gender) as gender', 'missingperson', $db, "WHERE gender='M'", 'gender');
echo "Male ".$male[0]."<br>";

// MISSING PERSONS FEMALE
$female = get_data('COUNT(gender) as gender', 'missingperson', $db, "WHERE gender='F'", 'gender');
echo "Female ".$female[0]."<br>";

// MISSING PERSONS TRANS
$trans = get_data('COUNT(gender) as gender', 'missingperson', $db, "WHERE gender='O'", 'gender');
echo "trans ".$trans[0]."<br>";

// TOTAL CAMPS
$totalCamps = get_data('COUNT(id) as id', 'campdetails', $db, "", 'id');
echo "totalCamps ".$totalCamps[0]."<br>";

// PEOPLE CAPACITY INCLUDING ALL CAMPS
$peopleCapacity = get_data('SUM(peopleCapacity) as peopleCapacity', 'campdetails', $db, "", 'peopleCapacity');
echo "peopleCapacity Including All Camps".$peopleCapacity[0]."<br>";

// PEOPLE IN ALL CAMPS
$peopleInAllCamps = get_data('COUNT(id) as id', 'personsincamp', $db, "", 'id');
echo "peopleInAllCamps ".$peopleInAllCamps[0]."<br>";

// PERSON IN CAMP MALE
$maleInCamps = get_data('COUNT(gender) as gender', 'missingperson', $db, "WHERE gender='M' OR gender='Male'", 'gender');
echo "Males In Camp ".$maleInCamps[0]."<br>";

// PERSON IN CAMP FEMALE
$femaleinCamps = get_data('COUNT(gender) as gender', 'missingperson', $db, "WHERE gender='F' OR gender='Female'", 'gender');
echo "Female In Camp ".$femaleinCamps[0]."<br>";

// PERSON IN CAMP OTHER
$transInCamps = get_data('COUNT(gender) as gender', 'missingperson', $db, "WHERE gender='O' OR gender='Trance'", 'gender');
echo "Trans In Camp ".$transInCamps[0]."<br>";


/* WANT TO DO IN DASHBOARD 

 - CALCULATE AGE USING DATE OF BIRTH IN PERSONS IN CAMP
 - DEFFERENTIATE OLDER CITIZENS AND YOUNG AND CHILD USING AGE IN CAMP PERSONS
 - TOTAL NEED OF FOOD, WATER, ETC IN CAMPS
 - NEED IN EACH CAMP
 - TOTAL RESOURCES WE HAVE
 - TOTAL NUMBER OF VOLUNTEERS
 - VOLUNTEERS IN EACH DISTRICT
 

*/

?>

    <div class="w3-bar w3-teal w3-container">
        <a href="index.php" class="w3-bar-item">Home</a> &#10095;
        <a href="dashboard.php" class="w3-bar-item">Dashboard</a>
    </div>

<?php
require('footer.php');
?>