<?php
$title = "Camp Needs Form";
require 'header.php';
?>
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
        <h4>Camp Needs Form</h4>
    </header>
    <form action="process.php" method="post">
    <input type="hidden" name="origin" value="campneeds">
    <label>State</label>
    <input type="text" class="w3-input w3-border" name="state" id="state">
    <label>Camp Number</label>
    <input type="text" class="w3-input w3-border" name="campno" id="campno">
    <label>Requestee Name</label>
    <input type="text" class="w3-input w3-border" name="reqname" id="reqname">
    <label>Requestee Phone</label>
    <input type="text" class="w3-input w3-border" name="reqphone" id="reqphone">

<?php
// GET NEEDS FROM NEEDS.CSV FILE
$file = fopen("csv/needs.csv", "r");

// CONVERT CSV TO ARRAY
$needs = fgetcsv($file);

// CLOSING FILE
fclose($file);

$str = "";

foreach($needs as $el){
    $str.="<label>".$el."</label>";
    $str.='<input type="text" class="w3-input w3-border" value="" name="'.$el.'" id="'.$el.'">';
}

echo $str;

?>

    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">
</form>
</div>
</div>

<?php
require 'footer.php';
?>