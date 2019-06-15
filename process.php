<?php
require 'config.php';
$origin = $_POST['origin'];

if ($origin == 'campneeds') {
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

    $db = 'id9965532_camp';
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    insert_row("campneeds_history", $state, $campno, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");
    /*
    $sql = "SELECT * FROM campneeds WHERE campno='" . $campno . "'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
     */
    if (row_excist('campneeds', "campno=" . $campno)) {
        // UPDATE CAMPNEEDS TABLE
        $table = "campneeds";
        $where = "campno='" . $campno . "'";
        $update = "food=food+" . $food . ",water=water+" . $water . ",clothing=clothing+" . $clothing . ",medicine=medicine+" . $medicine . ",cooking=cooking+" . $cooking . ",sanitary=sanitary+" . $sanitary;
        update_row($table, $where, $update);
    } else if ($result->num_rows == 0) {
        insert_row("campneeds", $state, $campno, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");
    } else {
        echo "Something went wrong! Try Again.";
    }

    $conn->close();
    header('location: campneeds.php?status=Data Uploaded Successfully');
}

if ($origin == 'donation') {
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

    $db = 'id9965532_camp';
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    insert_row("donationindi", $state, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");
    insert_row("resources", $state, $reqname, $reqphone, $water, $food, $clothing, $medicine, $cooking, $sanitary, "NO");

    $conn->close();
    header('location: donation.php?status=Data Uploaded Successfully');
}

if ($origin == 'createCamp') {
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

    $db = 'id9965532_camp';
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sent = insert_row("campDetails", $name, $adminName, $adminPhone, $alterPhone, $adminMail, $peopleCapacity, $availDoctor, $availVolunteer, $kitchen, $toilet, $peopleNow);
    error_log($sent);

    if ($sent) {
        $id = get_last_row("CampDetails", "id");

        $conn->close();
        header('location: createCamp.php?status=Data Uploaded Successfully. Your Camp Id is:' . $id . '');
    }
}

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
    
    
    $sent = insert_row("missingPerson", $state, $name, $description, $age, $gender, $guardianName, $district, $lastLocation, $missingDate, $address, $reportedBy, $reportersNumber, $policeStation, $relativeName, $relativeNumber, $relativeNameSec, $relativeNumberSec, $relativeNameThird, $relativeNumberThird);
    error_log($sent);

    if ($sent) {

        $conn->close();
        header('location: missingPerson.php?status=Data Uploaded Successfully.');
    }
}

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
  
    
    
    $sent = insert_row("newvolunteer", $name, $phone, $district, $orgonization, $area, $address);
    error_log($sent);

    if ($sent) {
        echo "DATA AUPLOADED SUCCESFULLY";
        $conn->close();
        //header('location: newVolunteer.php?status=Data Uploaded Successfully.');
    }
}