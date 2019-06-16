<?php

// ADD CONFIG.PHP
require 'config.php';

// GEIING SOURCE NAME
$origin = $_POST['origin'];

// IF ORIGIN IS CAMPNEEDS
if ($origin == 'campneeds') {

    // GETTING ALL POST VALUES FROM CAMPNEEDS
    $state = $_POST['state'];
    $campno = $_POST['campno'];
    $reqname = $_POST['reqname'];
    $reqphone = $_POST['reqphone'];
    $water = $_POST['water'];
    $food = $_POST['food'];
    $clothing = $_POST['clothing'];
    $medicine = $_POST['medicine'];
    $cooking = $_POST['cooking'];
    $sanitary = $_POST['sanitary'];

    // SETTING DB
    $db = 'id9965532_camp';

    // CREATE CONNECTION 
    $conn = new mysqli($servername, $username, $password, $db);
    
    // IF CONNECTION ERROR OCCURED
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // INSERT A RAW IN CAMPNEEDS HISTORY [INSERT ROW IS NOT AN INBUILT FUNCTION ITS DECLARED IN CONFIG.PHP]
    insert_row("campneeds_history", $state, $campno, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");

    // CHECK IF ROW EXIST IN CAMPNEEDS TABLE USING FUNCTION ROW EXIST[CONFIG.PHP]
    if (row_excist('campneeds', "campno=" . $campno)) {
        
        // IF EXIST UPDATE CAMPNEEDS TABLE
        $table = "campneeds";
        $where = "campno='" . $campno . "'";
        $update = "food=food+" . $food . ",water=water+" . $water . ",clothing=clothing+" . $clothing . ",medicine=medicine+" . $medicine . ",cooking=cooking+" . $cooking . ",sanitary=sanitary+" . $sanitary;
        
        update_row($table, $where, $update);
    } 

    // IF ROW DOESN'T EXIST INSERT NEW ROW [CONFIG.PHP]
    else if ($result->num_rows == 0) {
        insert_row("campneeds", $state, $campno, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");
    } else {
        // ELSE SOMETHING WENT WRONG
        echo "Something went wrong! Try Again.";

        // SETTING ERROR LOG
        error_log("ERROR OCCURED : AS RESULT NUM_ROWS != O OR 1");
    }

    // CLOSING DATABASE CONNECTION
    $conn->close();

    // REDIRECTING TO SOURCE PAGE WITH MESSAGE
    header('location: campneeds.php?status=Data Uploaded Successfully');
}

// IF ORIGIN IS DONATION
if ($origin == 'donation') {

    // GETTING POST VALUES
    $state = $_POST['state'];
    $reqname = $_POST['reqname'];
    $reqphone = $_POST['reqphone'];
    $water = $_POST['water'];
    $food = $_POST['food'];
    $clothing = $_POST['clothing'];
    $medicine = $_POST['medicine'];
    $cooking = $_POST['cooking'];
    $sanitary = $_POST['sanitary'];
    //$location = $_POST['location'];

    // SETTING DB
    $db = 'id9965532_camp';

    // CREATES CONNECTION
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // INSERT INTO TWO TABLES ONE FOR REFERENCE
    insert_row("donationindi", $state, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");
    insert_row("resources", $state, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");

    // CLOSES CONNECTION
    $conn->close();

    // REDIRECTING TO SOURCE PAGE
    header('location: donation.php?status=Data Uploaded Successfully');
}


// IF ORIGIN IS CREATECAMP
if ($origin == 'createCamp') {

    // GETTING POST VALUES
    $name = $_POST['name'];
    $adminName = $_POST['adminName'];
    $adminPhone = $_POST['adminPhone'];
    $alterPhone = $_POST['alterPhone'];
    $adminMail = $_POST['adminMale'];
    $peopleCapacity = $_POST['peopleCapacity'];
    $toilet = $_POST['toilet'];
    $kitchen = $_POST['kitchen'];
    $geoLocation = $_POST['geoLocation'];
    $availVolunteer = $_POST['availVolunteer'];
    $availDoctor = $_POST['availDoctor'];
    $peopleNow = $_POST['peopleNow'];


    // SETTING DB
    $db = 'id9965532_camp';

    // CREATES CONNECTION
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // INSERT INTO CAMPNEEDS
    if(insert_row("campDetails", $name, $adminName, $adminPhone, $alterPhone, $adminMail, $peopleCapacity, $toilet, $kitchen, $geoLocation, $availVolunteer, $peopleNow)){

        // GETTING ID OF LAST INSERTED ROW
        $id = get_last_row("CampDetails", "id");

        // CLOSE CONNECTION
        $conn->close();
        header('location: createCamp.php?status=Data Uploaded Successfully. Your Camp Id is:' . $id . '');
    } else{
        //  IF ERROR OCCURED
        error_log("CAMP DETAILS INSERT ROW ERROR OCCURED");
    }
}


// FOR MISSING PERSON OTHER ARE SAME AS ABOVE
if($origin == 'missingPerson'){

    $db = 'id9965532_camp';

    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $state = $_POST['state'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $guardianName = $_POST['guardianName'];
    //$photo = $_POST['photo'];
    $district = $_POST['district'];
    $lastLocation = $_POST['lastLocation'];
    $missingDate = $_POST['missingDate'];
    $address = $_POST['address'];
    $reportedBy = $_POST['reportedBy'];
    $reportersNumber = $_POST['reportersNumber'];
    $policeStation = $_POST['policeStation'];
    $relativeName = $_POST['relativeName'];
    $relativeNumber = $_POST['relativeNumber'];
    $relativeNameSec = $_POST['relativeNameSec'];
    $relativeNumberSec = $_POST['relativeNumberSec'];
    $relativeNameThird = $_POST['relativeNameThird'];
    $relativeNumberThird = $_POST['relativeNumberthird'];    
    
    
    if(insert_row("missingPerson", $state, $name, $description, $age, $gender, $guardianName, $district, $lastLocation, $missingDate, $address, $reportedBy, $reportersNumber, $policeStation, $relativeName, $relativeNumber, $relativeNameSec, $relativeNumberSec, $relativeNameThird, $relativeNumberThird)){
        $conn->close();
        header('location: missingPerson.php?status=Data Uploaded Successfully.');
    } else{
        error_log("ERROR OCCURED WHILE INSERTING ROW IN MISSIN PERSON");
    }
}

// IF ORIGIN IS NEW VOLUNTEER OTHERS ARE SAME AS ABOVE
if($origin == 'newVolunteer'){

    $db = 'id9965532_camp';

    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $district = $_POST['district'];
    $orgonization = $_POST['organization'];
    $area = $_POST['area'];
    $address = $_POST['address'];
  
    
    if(insert_row("newvolunteer", $name, $phone, $district, $orgonization, $area, $address)){
        echo "DATA AUPLOADED SUCCESFULLY";
        $conn->close();
        //header('location: newVolunteer.php?status=Data Uploaded Successfully.');
    } else{
        error_log("ERROR OCCURED IN INSERTING NEW ROW IN NEW VOLUNTEER");
    }
}