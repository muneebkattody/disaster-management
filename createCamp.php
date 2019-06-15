<?php
$title = "Create Camp";
require('header.php');
?>
<script>
    getLocation();
</script>
</head>
<body>
<p><?php if(!empty($_GET['status'])) echo $_GET['status'] ?></p>
<form action="process.php" method="post">
    <input type="hidden" name="origin" value="createCamp">
    State<input type="text" name="name" id="name"><br>
    Admin Name<input type="text" name="adminName" id="adminName"><br>
    Admin Phone<input type="text" name="adminPhone" id="adminPhone"><br>
    Alternative Phone<input type="number" name="alterPhone" id="alterPhone">Water<br>
    Admin Male<input type="number" name="adminMale" id="adminMale">Food<br>
    People Capacity<input type="number" name="peopleCapacity" id="clothing">Clothing<br>
    toilet<input type="number" name="toilet" id="toilet">Medicine<br>
    Kitchen<input type="number" name="kitchen" id="kitchen">Cooking<br>
    GeoLocation<input type="number" name="geoLocation" id="geoLocation">Sanitary<br>
    Available Doctors<input type="number" name="availDoctor" id="availDoctor">Sanitary<br>
    People Now<input type="number" name="peopleNow" id="peopleNow">Sanitary<br>
    Available volunteers<input type="number" name="availVolunteer" id="availVolunteer"><br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<?php
require('footer.php');
?>