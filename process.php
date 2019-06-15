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
    
    $sent = insert_row("missingPerson", $name, $adminName, $adminPhone, $alterPhone, $adminMail, $peopleCapacity, $availDoctor, $availVolunteer, $kitchen, $toilet, $peopleNow);
    error_log($sent);
}