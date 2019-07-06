<?php
$title = "Dissaster Management Software";
require 'header.php';
?>
<style>
.w3-card-2{
    margin:10px;
    padding:15px;
    border-radius:5px;
    color: rgba(0,0,0,.75);
    transition: .3s;
    border : 1.5px solid rgba(0,0,0,0);
}
.w3-card-2:hover{
    border : 1.5px solid rgba(0,0,0,.5);
}
.w3-card-2 a{
    text-decoration: none;
}
.m-btm{
    margin-bottom: 35px;
}
.m-top{
    margin-top:50px;
}
</style>
</head>
<body>
    <header class="w3-container w3-teal m-btm">
<h1>Disaster Management Software</h1>
<h6>Powerd by AardWolf &reg;</h6>
</header>
    <div class="w3-row">
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="campneeds.php">
                <header>
                    <h4>Camp Needs Form</h4>
                </header>
                <hr>
                <p>
                Form for request needs and helps for your camp. 
                Request for goods like food, water, etc.
                </p>
                </div>
            </a>
            </div>  
        </div>
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="donation.php">
                <header>
                    <h4>Donation Form</h4>
                </header>
                <hr>
                <p>
                Form to donate individually and organizational. It can be money, food, etc.
                </p>
                </div>
            </a>
            </div>  
        </div>
    <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="analysis.php">
                <header>
                    <h4>Ananlysis and Results</h4>
                </header>
                <hr>
                <p>
                The computer will process all the data available and get reults that hoe to manage resources and other things.
                </p>
                </div>
            </a>
            </div>  
        </div>
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="createCamp.php">
                <header>
                    <h4>Create Camp Form</h4>
                </header>
                <hr>
                <p>
                Form for request needs and helps for your camp. 
                Request for goods like food, water, etc.
                </p>
                </div>
            </a>
            </div>  
        </div>
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="missingPerson.php">
                <header>
                    <h4>Missing Persons Form</h4>
                </header>
                <hr>
                <p>
                Form for request needs and helps for your camp. 
                Request for goods like food, water, etc.
                </p>
                </div>
            </a>
            </div>  
        </div>
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="volunteer.html">
                <header>
                    <h4>Volunteer Form</h4>
                </header>
                <hr>
                <p>
                Form for request needs and helps for your camp. 
                Request for goods like food, water, etc.
                </p>
                </div>
            </a>
            </div>  
        </div>
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="personsInCamp.php">
                <header>
                    <h4>Persons In Camp Form</h4>
                </header>
                <hr>
                <p>
                Form for request needs and helps for your camp. 
                Request for goods like food, water, etc.
                </p>
                </div>
            </a>
            </div>  
        </div>
        <div class="w3-col s12 m6 l3">
            <div class="w3-card-2">
            <div class="w3-container">
            <a href="dashboard.php">
                <header>
                    <h4>Status About All</h4>
                </header>
                <hr>
                <p>
                Here you can view all the status of the camps people and all data.
                With well ditributed form.
                </p>
                </div>
            </a>
            </div>  
        </div>
</div>
</div>

<?php
require 'config.php';
$dbHandle = new DBController;

// TOTAL CAMPS
$totalCamps = $dbHandle->get_data('COUNT(id) as id', 'campdetails', "", 'id');

// PEOPLE CAPACITY INCLUDING ALL CAMPS
$peopleCapacity = $dbHandle->get_data('SUM(peopleCapacity) as peopleCapacity', 'campdetails', "", 'peopleCapacity');

// PEOPLE IN ALL CAMPS
$peopleInAllCamps = $dbHandle->get_data('COUNT(id) as id', 'personsincamp', "", 'id');

?>

<footer class="w3-container w3-teal m-top">
    <div class="w3-container">
        <h4 class="m-top">Status Of Camps</h4>
        <hr>
        <div class="w3-row">
            <div class="w3-col w3-m12 s12 l4">
                <p>Total Camps - <?php echo $totalCamps[0] ?></p>
            </div>
            <div class="w3-col w3-m12 s12 l4">
                <p>People Capacity Include All camps - <?php echo $peopleCapacity[0] ?></p>
            </div>
            <div class="w3-col w3-m12 s12 l4">
                <p>Peoples In All Camps - <?php echo $peopleInAllCamps[0] ?></p>
            </div>
        </div>
    </div>
    <div class="social-footer"> Contribute On <a href="http://github.com/muneebkattody/disaster-management/">GitHub</a></div>
</footer>
<?php
require 'footer.php';
?>