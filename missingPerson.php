<?php
$title = "Missing Person Camp";
require 'header.php';
?>
<script>
    getLocation();
</script>
<style>
    input[type=text].w3-input {
        margin-bottom:20px;
    }
    input[type=radio].w3-input {
        margin-bottom:20px;
    }
    input[type=file].w3-input {
        margin-bottom:20px;
    }
    textarea.w3-input {
        margin-bottom:20px;
    }
</style>
</head>
<body>

<header class="w3-container w3-teal m-btm">
<h1>Disaster Management Software</h1>
<h6>Powerd by AardWolf &reg;</h6>
</header>

<p><?php if (!empty($_GET['status'])) {
    echo $_GET['status'];
}
?></p>
<div class="w3-container">
    <div class="input-box w3-card-2">
    <header>
        <h4>Missing Person Form</h4>
    </header>
    <hr>
    <form action="process.php" method="post">
    <input type="hidden" name="origin" value="missingPerson">
    <label>State</label>
    <input type="text" class="w3-input w3-border" name="state" id="state">
    <label>Missing person's name</label>
    <input type="text" class="w3-input w3-border" name="name" id="name">
    <label>Description of the person (including identifying features)</label>
    <input type="text" class="w3-input w3-border" name="description" id="description">
    <label>Missing Person's age </label>
    <input type="text" class="w3-input w3-border" name="age" id="age">
    Missing Person's Gender <br>
    <p>
        <input type="radio" class="w3-radio" name="gender" id="male" value="M" checked>
        <label for="male" class="w3-validate">Male</label>
    </p>
    <p>
        <input type="radio" class="w3-radio" name="gender" id="female" value="F">
        <label  for="female" class="w3-validate">Female</label>
    </p>
    <p>
        <input type="radio" class="w3-radio" name="gender" id="other" value="O">
        <label for="other" class="w3-validate">Other</label>
    </p>

    <label for="huardianName">Father's/Mother's/Guardian's name</label>
    <input type="text" class="w3-input w3-border" name="guardianName" id="guardianName">
    <label for="photo">Missing person's photo</label>
    <input type="file" class="w3-input w3-border" name="photo" id="photo">
    <label for="district">District</label>
    <input type="text" class="w3-input w3-border" name="district" id="district">
    <label for="lastLocation">Last known location</label>
    <input type="text" class="w3-input w3-border" name="lastLocation" id="lastLocation">

    Missing date
    <div class="w3-row">
        <div class="w3-col m4 l4 s4">
            <input type="text" class="w3-input w3-border" name="missingDate" id="day" placeholder="dd">
        </div>
        <div class="w3-col m4 l4 s4">
            <input type="text" class="w3-input w3-border" name="missingDate" id="month" placeholder="mm">
        </div>
        <div class="w3-col m4 l4 s4">
        <input type="text" class="w3-input w3-border" name="missingDate" id="Year" placeholder="yyyy">
        </div>
    </div>

    <label for="address">Missing person's address</label>
    <textarea class="w3-input w3-border" name="address" id="address"></textarea>

    <label for="reportedBy">Reported by (Your name)</label>
    <input type="text" class="w3-input w3-border" name="reportedBy" id="reportedBy">

    <label for="reportersNumber">Reporter's(Your) phone number</label>
    <input type="text" class="w3-input w3-border" name="reportersNumber" id="reportersNumber">

    <label for="policeStation">Nearest Police station</label>
    <input type="text" class="w3-input w3-border" name="policeStation" id="policeStation">

    <label for="relativeName">Relative Name No 1</label>
    <input type="text" class="w3-input w3-border" name="relativeName" id="relativeName">

    <label for="relativeNumber">Relatives Mobile no 1</label>
    <input type="text" class="w3-input w3-border" name="relativeNumber" id="relativeNumber">

    <label for="relativeNameSec">Relative Name No 2</label>
    <input type="text" class="w3-input w3-border" name="relativeNameSec" id="relativeNameSec">

    <label for="relativeNumberSec">Relatives Mobile no 2</label>
    <input type="text" class="w3-input w3-border" name="relativeNumberSec" id="relativeNumberSec">

    <label for="relativeNameThird">Relative Name No 3</label>
    <input type="text" class="w3-input w3-border" name="relativeNameThird" id="relativeNameThird">

    <label for="relativeNumberThird">Relatives Mobile no 3</label>
    <input type="text" class="w3-input w3-border" name="relativeNumberthird" id="relativeNumberThird">

    <div class="w3-container w3-pale-green w3-leftbar w3-border-green">
        <p>We will send a link to these numbers in few days if duplicate entries are found, for avoid duplication . Stay connected.
        </p>
    </div>

    <br><br>

    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">

</form>
<?php
require 'footer.php';
?>