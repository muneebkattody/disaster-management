<?php
$title = "Create Camp";
require('header.php');
?>
<script>
    getLocation();
</script>
<p><?php if(!empty($_GET['status'])) echo $_GET['status'] ?></p>
<form action="process.php" method="post">
    <input type="hidden" name="origin" value="missingPerson">
    State<input type="text" name="state" id="state"><br>
    Missing person's name <input type="text" name="name" id="name"><br>
    Description of the person (including identifying features) <input type="text" name="description" id="description"><br>
    Missing person's age <input type="number" name="age" id="age"><br>
    Missing person's gender <input type="radio" name="gender" id="male" value="M">Male&nbsp;<input type="radio" name="gender" id="female" value="F">Female&nbsp;<input type="radio" name="gender" id="others" value="O"> Others&nbsp; <br>
    Father's/Mother's/Guardian's name<input type="text" name="guardianName" id="guardianName"><br>
    Missing person's photo <input type="file" name="photo" id="photo"><br>
    District <input type="text" name="district" id="district"><br>
    Last known location<input type="text" name="lastLocation" id="lastLocation"><br>
    Missing date<input type="text" name="missingDate" id="day">day &nbsp; <input type="text" name="missingDate" id="month">Month &nbsp;<input type="text" name="missingDate" id="Year">Year<br>
    Missing person's address<input type="text" name="address" id="address"><br>
    Reported by (Your name) <input type="text" name="reportedBy" id="reportedBy"><br>
    Reporter's(Your) phone number<input type="text" name="reportersNumber" id="reportersNumber"><br>
    Police station <input type="text" name="policeStation" id="policeStation"><br>
    Relative Name No 1  <input type="text" name="relativeName" id="relativeName"><br>
    Relatives Mobile no 1 <input type="text" name="relativeNumber" id="relativeNumber"><br>
    Relative Name No 2  <input type="text" name="relativeNameSec" id="relativeNameSec"><br>
    Relatives Mobile no 2 <input type="text" name="relativeNumberSec" id="relativeNumberSec"><br>
    Relative Name No 3  <input type="text" name="relativeNameThird" id="relativeNameThird"><br>
    Relatives Mobile no 3 <input type="text" name="relativeNumberthird" id="relativeNumberThird"><br>
   

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<?php
require('footer.php');
?>