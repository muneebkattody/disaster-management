<?php
$title = "Insert Need";
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
        <h4>Insert Needs</h4>
    </header>
    <hr>
    <form action="process.php" method="post" id="ajaxForm">
    <input type="hidden" name="origin" value="insertNeeds">
    <label>Needs To Add</label>
    <input type="text" class="w3-input w3-border" name="needs" id="state">


    <br><br>

    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">

</form>
<?php
require 'footer.php';
?>