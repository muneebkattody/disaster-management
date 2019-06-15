<?php
$title = "Donation";
require('header.php');
?>
<script>
    getLocation();
</script>
</head>
<body>
<p><?php if(!empty($_GET['status'])) echo $_GET['status'] ?></p>
<form action="process.php" method="post">
    <input type="hidden" name="origin" value="donation">
    State<input type="text" name="state" id="state"><br>
    Name<input type="text" name="reqname" id="reqname"><br>
    Phone<input type="text" name="reqphone" id="reqphone"><br>
    <input type="number" name="water" id="water">Water<br>
    <input type="number" name="food" id="food">Food<br>
    <input type="number" name="clothing" id="clothing">Clothing<br>
    <input type="number" name="medicine" id="medicine">Medicine<br>
    <input type="number" name="cooking" id="cooking">Cooking<br>
    <input type="number" name="sanitary" id="sanitary">Sanitary<br>
    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<?php
require('footer.php');
?>