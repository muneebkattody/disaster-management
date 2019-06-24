<?php
$title = "Create Camp";
require('header.php');
?>
<script>
    getLocation();
</script>
</head>
<body>

<header class="w3-container w3-teal m-btm">
<h1>Disaster Management Software</h1>
<h6>Powerd by AardWolf &reg;</h6>
</header>

<div id="ajaxDiv"></div>
<p><?php if(!empty($_GET['status'])) echo $_GET['status'] ?></p>
<div class="w3-container">
    <div class="input-box w3-card-2">
        <header>
            <h4>Create Camp</h4>
        </header>
        <hr>
<form action="process.php" method="post" id="ajaxForm">
    <input type="hidden" name="origin" value="createCamp">
    <label>State</label>
    <input type="text" class="w3-input w3-border" name="name" id="name"><br>
    <label>Admin Name</label>
    <input type="text" class="w3-input w3-border" name="adminName" id="adminName"><br>
    <label>Admin Phone</label>
    <input type="text" class="w3-input w3-border" name="adminPhone" id="adminPhone"><br>
    <label>Alternative Phone</label>
    <input type="text" class="w3-input w3-border" name="alterPhone" id="alterPhone"><br>
    <label>Admin Mail</label>
    <input type="text" class="w3-input w3-border" name="adminMale" id="adminMale"><br>
    <label>People Capacity</label>
    <input type="text" class="w3-input w3-border" name="peopleCapacity" id="clothing"><br>
    <label>Toilet</label>
    <input type="text" class="w3-input w3-border" name="toilet" id="toilet" size="1"><br>
    <label>Kitchen</label>
    <input type="text" class="w3-input w3-border" name="kitchen" id="kitchen"><br>
    <label>GeoLocation</label>
    <input type="text" class="w3-input w3-border" name="geoLocation" id="geoLocation"><br>
    <label>Available Doctors</label>
    <input type="text" class="w3-input w3-border" name="availDoctor" id="availDoctor"><br>
    <label>People Now</label>
    <input type="text" class="w3-input w3-border" name="peopleNow" id="peopleNow"><br>
    <label>Available volunteers</label>
    <input type="text" class="w3-input w3-border" name="availVolunteer" id="availVolunteer"><br>
    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">
</form>
</div>
</div>
<?php
require('footer.php');
?>