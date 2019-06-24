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
        <h4>Donation Form</h4>
    </header>
    <hr>
<form action="process.php" method="post" id="ajaxForm">
    <input type="hidden" name="origin" value="donation">
    <label>STATE</label>
    <input type="text" class="w3-input w3-border"   name="state" id="state">
    <label>NAME OF DONATEND</label>
    <input type="text" class="w3-input w3-border"   name="reqname" id="reqname">
    <label>PHONE</label>
    <input type="text" class="w3-input w3-border"   name="reqphone" id="reqphone">

    <div class="w3-container w3-pale-green w3-leftbar w3-border-green">
        <p>Quantities are asking for how many people can use it. Eg: 25kg food for 100 peoples. Then Enter 100 in food field.</p>
    </div>
    <br>

    <?php
// GET NEEDS FROM NEEDS.CSV FILE
$file = fopen("csv/needs.csv", "r");

$layout = "";

// CONVERT CSV TO ARRAY
// WHILE FOR TRAVERSAL EACH ROW
while(($needs = fgetcsv($file, ",")) !== FALSE){

foreach($needs as $el){
    $layout.="<label>".strtoupper($el)."</label>";
    $layout.='<input type="text" class="w3-input w3-border" value="" name="'.$el.'" id="'.$el.'">';
}
}

// CLOSING FILE
fclose($file);

// PRINT $layout
echo $layout;

?>

    <label>Anything More?</label>
    <textarea class="w3-input w3-border" name="more" id="more"></textarea>
    <br>

    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">
</form>
</div>
</div>
<?php
require 'footer.php';
?>