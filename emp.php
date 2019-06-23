<?php
$title = "Persons In Camp";
require 'header.php';
?>
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
        <h4>Persons In Camp Form</h4>
    </header>
    <hr>
    <form action="process.php" method="post">
    <input type="hidden" name="origin" value="personsInCamp">
    <label>Camp Number</label>
    <input type="text" class="w3-input w3-border" name="campNo" id="campno">
    
    <div class="w3-container w3-pale-green w3-leftbar w3-border-green">
        <p>Don't have CampNo?  <a href="createcamp.php">Register your camp now to get a camp no.</a></p>
    </div>
    <br>

    <label>First Name</label>
    <input type="text" class="w3-input w3-border" name="firstName" id="firstName">
    <label>Last Name</label>
    <input type="text" class="w3-input w3-border" name="lastName" id="lastName">
    
    Date Of Birth
    <div class="w3-row">
        <div class="w3-col m4 l4 s4">
            <input type="text" class="w3-input w3-border" name="birthDay" id="day" placeholder="dd">
        </div>
        <div class="w3-col m4 l4 s4">
            <input type="text" class="w3-input w3-border" name="birthMonth" id="month" placeholder="mm">
        </div>
        <div class="w3-col m4 l4 s4">
        <input type="text" class="w3-input w3-border" name="birthYear" id="Year" placeholder="yyyy">
        </div>
    </div>

    <label>Email Id</label>
    <input type="text" class="w3-input w3-border" name="emailId" id="emailId">
    <label>Mobile Number</label>
    <input type="text" class="w3-input w3-border" name="mobileNumber" id="reqphone">

    Person's Gender <br>
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

    <label for="medicine">Using Regular Medicines?</label>
    <div id="med-box"></div>
    <input type="button" class="w3-input w3-border" value="Add Medicine" id="addMedicine"/>
    <br>


    <label>Address</label>
    <textarea class="w3-input w3-border" name="address" id="address"></textarea>

    <label>City</label>
    <input type="text" class="w3-input w3-border" name="city" id="city">

    <label>State</label>
    <input type="text" class="w3-input w3-border" name="state" id="state">

    <label>Pin</label>
    <input type="text" class="w3-input w3-border" name="pinCode" id="pinCode">

    <div class="w3-container w3-pale-green w3-leftbar w3-border-green">
        <p>Fill the needed fields only.</p>
    </div>
    <br>

    <label>Anything More?</label>
    <textarea class="w3-input w3-border" name="more" id="more"></textarea>

    <input type="submit" class="w3-btn w3-blue" value="Submit">
    <input type="reset" class="w3-btn w3-red" value="Reset">
</form>
</div>
</div>

<?php
require 'footer.php';
?>