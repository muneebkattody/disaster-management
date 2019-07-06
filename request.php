<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/w3.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
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
        <h4>request</h4>
    </header>
    <hr>
    <form action="process.php" method="post">
    <input type="hidden" name="origin" value="request for help">
    <label>State</label>
    <input type="text" class="w3-input w3-border" name="state" id="state">
    <label>location</label>
    <input type="text" class="w3-input w3-border" name="location" id="location">
    <label> requesties name </label>
    <input type="text" class="w3-input w3-border" name="name" id="name">
  
    <label>phone number </label>
    <input type="text" class="w3-input w3-border" name="numbers" id="numbers">

    

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
    needed fast <br>
    <p>
        <input type="text class="w3-radio" name="rescue" id="need rescue" value="0" checked>
        <label for="need rescue" class="w3-validate">need rescue</label>
    </p>
    <p>
        <input type="text" class="w3-radio" name="needs" id="female" value="0">
        <label  for="female" class="w3-validate">water</label>
    </p>
    <p>
        <input type="text" class="w3-radio" name="needs" id="other" value="0">
        <label for="other" class="w3-validate">clothing</label>
    </p>
    <p>
        <input type="text" class="w3-radio" name="needs" id="other" value="0">
        <label for="other" class="w3-validate">food</label>
        <p>
            <input type="text" class="w3-radio" name="needs" id="other" value="">
            <label for="other" class="w3-validate">toiletries</label>
        </p>
        
    <label>Anything More?</label>
    <textarea class="w3-input w3-border" name="more" id="more"></textarea>
    <br>

    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">
</form>
</div>
</div>

</form>

    
