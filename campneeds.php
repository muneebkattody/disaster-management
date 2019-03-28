<?php
$title = "Camp Needs Form";
require 'header.php';
?>
<p><?php if(!empty($_GET['status'])) echo $_GET['status'] ?></p>
<form action="process.php" method="post">
    <input type="hidden" name="origin" value="campneeds">
    State<input type="text" name="state" id="state"><br>
    Campno<input type="text" name="campno" id="campno"><br>
    requestee Name<input type="text" name="reqname" id="reqname"><br>
    Requestee Phone<input type="text" name="reqphone" id="reqphone"><br>
    <input type="number" value="0" name="water" id="water">Water<br>
    <input type="number" value="0" name="food" id="food">Food<br>
    <input type="number" value="0" name="clothing" id="clothing">Clothing<br>
    <input type="number" value="0" name="medicine" id="medicine">Medicine<br>
    <input type="number" value="0" name="cooking" id="cooking">Cooking<br>
    <input type="number" value="0" name="sanitary" id="sanitary">Sanitary<br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<?php
require 'footer.php';
?>