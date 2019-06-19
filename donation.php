<?php
$title = "Donation";
require 'header.php';
?>
<script>
    getLocation();
</script>
<style>
    input{
        margin-bottom:20px;
    }
</style>
</head>
<body>
<p><?php if (!empty($_GET['status'])) {
    echo $_GET['status'];
}
?></p>
<div class="w3-container">
    <div class="input-box w3-card-2">
    <header>
        <h4>Donation Form</h4>
    </header>
    <hr>
<form action="process.php" method="post">
    <input type="hidden" name="origin" value="donation">
    <label>STATE</label>
    <input type="text" class="w3-input w3-border"   name="state" id="state">
    <label>NAME OF DONATED</label>
    <input type="text" class="w3-input w3-border"   name="reqname" id="reqname">
    <label>PHONE</label>
    <input type="text" class="w3-input w3-border"   name="reqphone" id="reqphone">

<?php
// GET NEEDS FROM NEEDS.CSV FILE
$file = fopen("csv/needs.csv", "r");

// CONVERT CSV TO ARRAY
$needs = fgetcsv($file);

// CLOSING FILE
fclose($file);

$str = "";

$layout = "";

foreach ($needs as $el) {
    $layout .= "<label>" . strtoupper($el) . "</label>";
    $layout .= '<input type="text" class="w3-input w3-border"   name="' . $el . '" id="' . $el . '">';
}

echo $layout;
?>
    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">
</form>
</div>
</div>
<?php
require 'footer.php';
?>