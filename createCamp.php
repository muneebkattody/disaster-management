<?php
$title = "Create Camp";
require('header.php');
?>
<script>
    getLocation();
</script>
</head>
<body>
<div id="ajaxDiv"></div>
<p><?php if(!empty($_GET['status'])) echo $_GET['status'] ?></p>
<form action="process.php" method="post">
    <input type="hidden" name="origin" value="createCamp">
    State<input type="text" name="name" id="name"><br>
    Admin Name<input type="text" name="adminName" id="adminName"><br>
    Admin Phone<input type="text" name="adminPhone" id="adminPhone"><br>
    Alternative Phone<input type="number" name="alterPhone" id="alterPhone"><br>
    Admin Male<input type="number" name="adminMale" id="adminMale"><br>
    People Capacity<input type="number" name="peopleCapacity" id="clothing"><br>
    toilet<input type="number" name="toilet" id="toilet" size="1"><br>
    Kitchen<input type="number" name="kitchen" id="kitchen"><br>
    GeoLocation<input type="number" name="geoLocation" id="geoLocation"><br>
    Available Doctors<input type="number" name="availDoctor" id="availDoctor"><br>
    People Now<input type="number" name="peopleNow" id="peopleNow"><br>
    Available volunteers<input type="number" name="availVolunteer" id="availVolunteer"><br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<?php
require('footer.php');
?>