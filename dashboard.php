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

$dbHandle = new DBController;
// GETTING STATISTIcS OF MISSING PERSON

// MISSING PERSON MALE
$male = $dbHandle->get_data('COUNT(gender) as gender', 'missingperson', "WHERE gender='M'", 'gender');
echo "Male ".$male[0]."<br>";

// MISSING PERSONS FEMALE
$female = $dbHandle->get_data('COUNT(gender) as gender', 'missingperson', "WHERE gender='F'", 'gender');
echo "Female ".$female[0]."<br>";

// MISSING PERSONS TRANS
$trans = $dbHandle->get_data('COUNT(gender) as gender', 'missingperson', "WHERE gender='O'", 'gender');
echo "trans ".$trans[0]."<br>";

// TOTAL CAMPS
$totalCamps = $dbHandle->get_data('COUNT(id) as id', 'campdetails', "", 'id');
echo "totalCamps ".$totalCamps[0]."<br>";

// PEOPLE CAPACITY INCLUDING ALL CAMPS
$peopleCapacity = $dbHandle->get_data('SUM(peopleCapacity) as peopleCapacity', 'campdetails', "", 'peopleCapacity');
echo "peopleCapacity Including All Camps".$peopleCapacity[0]."<br>";

// PEOPLE IN ALL CAMPS
$peopleInAllCamps = $dbHandle->get_data('COUNT(id) as id', 'personsincamp', "", 'id');
echo "peopleInAllCamps ".$peopleInAllCamps[0]."<br>";

// PERSON IN CAMP MALE
$maleInCamps = $dbHandle->get_data('COUNT(gender) as gender', 'missingperson', "WHERE gender='M' OR gender='Male'", 'gender');
echo "Males In Camp ".$maleInCamps[0]."<br>";

// PERSON IN CAMP FEMALE
$femaleinCamps = $dbHandle->get_data('COUNT(gender) as gender', 'missingperson', "WHERE gender='F' OR gender='Female'", 'gender');
echo "Female In Camp ".$femaleinCamps[0]."<br>";

// PERSON IN CAMP OTHER
$transInCamps = $dbHandle->get_data('COUNT(gender) as gender', 'missingperson', "WHERE gender='O' OR gender='Trance'", 'gender');
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