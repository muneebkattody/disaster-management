<?php
require 'config.php';
class Analysis extends DBController{
    private $header;
    private $needs;
    private $allResources;
    private $allNeeds;
    private $sumAllNeeds;
    private $supply;
    private $camps;

    // BALENCE OF AVAIL - IF AVAIL > NEED
    private $balence = [];

    function __construct(){
        parent::__construct();
        $file = fopen("csv/needs.csv","r");
        $this->needs = array();
        while(($row = fgetcsv($file)) !== FALSE){
            foreach($row as $el)
            array_push($this->needs,$el);
        }
        fclose($file);
    }

    function headerCreate(){
        $title = "Result Generator";
        require 'header.php';
    }

    function getAllResources(){
        // TRY TO GET ALL AVAILBALE RESOURCES BY SUMMATION ALL DONATIONS
        // SET MY SQL STRIING TO SELECT VALUES FROM DONATIONINDI TABLE IN DONATION DB
        $sql = "SELECT ";
        foreach($this->needs as $el){
            $sql .= "SUM($el) AS $el";
            if(!($el==end($this->needs))){
                $sql .= ",";
            }
        }
        $sql .= " FROM donationindi";
        $result = DBController::runBaseQuery($sql);
    
        foreach($this->needs as $el){
            $this->allResources[$el] = $result[0][$el];
        }
    }

    function getAllNeeds(){
        // GET NEEDS FOR EACH CAMP AND THE CATOGORY OF NEEDS

        // GETTING NEEDS FOR CAMPS FROM CAMPNEEDS
        $sql = "SELECT * FROM campneeds";
        $result = DBController::runBaseQuery($sql);
        foreach($result as $row){
            $campno = $row['campno'];
            foreach($this->needs as $el){
            $this->allNeeds[$el][$campno] = $row[$el];
            }
        }

        // NEED TOTAL BASE
        $sql = "SELECT ";
        foreach($this->needs as $el){
            $sql .= "SUM($el) AS $el";
            if(!($el==end($this->needs))){
                $sql .= ",";
            }
        }
        $sql .= " FROM campneeds";
        $result = DBController::runBaseQuery($sql);
        foreach($this->needs as $el){
            $this->sumAllNeeds[$el] = $result[0][$el];
        }
    }

    function printStatus(){
        $this->getAllResources();
        $this->getAllNeeds();
        echo <<<HTML
        <table class='w3-bordered w3-border w3-table'>
            <tr>
                <th>Goods</th><th>Need</th><th>Available</th>
            </tr>
HTML;
        foreach($this->needs as $el){   
            echo "<tr><td>$el</td><td> {$this->sumAllNeeds[$el]} </td><td> {$this->allResources[$el]} </td></tr>";
        }
        echo "</table>";
    }

    function distribute(){
        // DEVIDE AVAILBALE RESOURCES TO EACH CAMPS NY USING DEVIDER FUNCTION
        foreach($this->needs as $el)
        $this->supply[$el] = $this->devider($this->allResources[$el], $this->allNeeds[$el], $this->sumAllNeeds[$el]);

        //SETTING TABLE LAYOUT
        echo <<<HTML
        <div class='w3-responsive'>
            <table class='w3-bordered w3-border w3-table'>
                <tr>
                    <th>Camp no.</th>
HTML;
        foreach($this->needs as $el){
            echo "<th>$el</th>";
        } 
        echo "</tr>";



        // STORE CAMP NUMBERS
        $this->camps = array_keys($this->allNeeds[$this->needs[0]]);
        $layout = "";
        foreach ($this->camps as $key => $cn) {
            // STORE EACH VAUES CORRESPONDINGLY
            $layout.="<tr><td rowspan='1'>" . $cn . "</td>";
            foreach($this->needs as $el){
            $layout.="<td>".$this->supply[$el][$key];
            }
            $layout.="</tr>";
        }
        $layout.="</table></div>";

        echo $layout;

    }

    function storeTempResult(){
        foreach ($this->camps as $key => $cn) {
            if (DBController::row_exist('temp_result', "campno=" . $cn)) {
                $table = "campneeds";
                $where = "campno='" . $cn . "'";
                foreach($needs as $el){
                    $update = $el."=" . $supply[$el][$key];
                }
                DBController::update_row($table, $where, $update);
            }
        
            $tempArray = [];
            foreach($needs as $el){
                array_push($tempArray, $supply[$el][$key]);
            }
        
            DBController::insert_row("temp_result", $cn, $tempArray);
        }
    }

    function printRemining(){
        $layout = "REMINING RESOURCES ";
        foreach($this->needs as $key=>$el){
            $layout.="<br> ".$el.":" . ($this->supply[$el][count($this->camps)] + $this->balence[$key]);
        }
        echo $layout;
    }

    // DEVIDER FUNCTION TO DEVIDE AVAILBALE RESOURCE TO CAMP NEEDS
    function devider($s, $vars, $total_need)
    {
        // IF AVAILBALE IS GREATER THAN NEEDED THEN DEVIDER GIVES GOODS MORE THAN NEEDED TO AVOID THIS
        // ADD THIS TO BALENECE AND SET AVAIL = NEEDED
        $s = $s;
        if ($s > $total_need) {
            array_push($this->balence, $s - $total_need);
            $s = $total_need;
        } else {
            array_push($this->balence, 0);
        }
        $sum = 0;
        $ret_val = [];
        foreach ($vars as $n) {
            $sum += $n;
        }
        foreach ($vars as $n) {
            $v = ($n * 100) / $sum;
            $v = intval(($s * $v) / 100);
            array_push($ret_val, $v);
        }
        // FINDING REMINING RESOURCES
        $sum = 0;
        foreach ($ret_val as $n) {
            $sum += $n;
        }
        // echo $sum . "<BR>";
        $rem = $s - $sum;
        array_push($ret_val, $rem);

        return $ret_val;
    }


}

?>


</head>
<body>
<header class="w3-container w3-teal m-btm">
<h1>Disaster Management Software</h1>
<h6>Powerd by AardWolf &reg;</h6>
</header>

<?php
$analysis = new Analysis;
$analysis->headerCreate();
$analysis->printStatus();
$analysis->distribute();
$analysis->printRemining();
?>
