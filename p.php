







<?php
class DBController {
	private $host = "localhost";
	private $user = "id9965532_admin";
	private $password = "aardWolf";
	private $database = "id9965532_camp";
	private $conn;
	
    function __construct() {
        $this->conn = $this->connectDB();
	}	
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
    }
	
    function runBaseQuery($query) {
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        return $resultset;
    }


    // FUNCTION TO INSERT ROW
    function insert_row(...$args)
    {
        // GETTING TABLE VALUE
        $table = $args[0];

        // REMOVE TABLE VALUE FROM ARRAY
        array_shift($args);

        // DECLARE VARIABLE FOR STORING TABLE VALUES
        $val = "0";
        foreach ($args as $v) {

            //STORING ARRAY TO VARIABLE

            //IF ARRAY VERIABLE IS AN ARRAY
            if(is_array($v)){
                foreach($v as $el){
                    $val .= ",'" . $el . "'";
                }
            } else{
                $val .= ",'" . $v . "'";
            }
        }
        
        // SQL FOR INSERT ROW
        $sql = "INSERT INTO " . $table . " VALUES(" . $val . ")";



        if ($this->conn->query($sql)) {
            
            return TRUE;
        } else {
            error_log("ERROR OCCURED WHILE EXCECUTING SQL IN INSERT_ROW FUNCTION : ".$this->conn->error);
            return FALSE;
        }
    }
    
    // FUNCTION TO CHECK WHETHER A ROW EXIST IN TABLE
    function row_exist($table, $where)
    {
        global $result;
        $sql = "SELECT * FROM " . $table . " WHERE " . $where;
        
        //$result = $conn->query($sql);
        
        if($this->conn->query($sql)) {
            return TRUE;
        } else {
            error_log("ERROR OCCURED WHILE ECECUTING SQL IN ROW_EXIST FUNTION : ".$conn->error);
            return FALSE;
        }
    }
    
    // FUNCTION FOR UPDATE A ROW OF TABLE
    function update_row(...$args){

        $table = $args[0];
        array_shift($args);
        $where = $args[0];
        array_shift($args);

        $val = "";
        foreach ($args as $v) {
            $val .= "" . $v . ",";
        }

        $val = substr(trim($val), 0, -1);

        $sql = "UPDATE " . $table . " SET " . $val . " WHERE " . $where;
        error_log($sql);

        if ($this->conn->query($sql)) {
            return TRUE;
        } else {
            error_log("ERROR OCCURED IN UPDATE_ROW() : ".$this->conn->error);
            return FALSE;
        }
    }

    // GET DATA OF SPECIFIC COLUMN FROM SPECIFIC TABLE
    function get_data($col, $table, $where="", $colToGet=FALSE){

        $array = [];

        $sql = "SELECT ".$col." FROM ".$table." ".$where;


        if($colToGet){
            $col = $colToGet;
        }
        
        $result = $this->conn->query($sql);

        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                array_push($array, $row[$col]);
            }

            return $array;
        } else {
            error_log("ERROR IN GET_DATA : RESULTING LESS THAN ONE OR NO ROWS");
            return false;
        }
    }

    // FUNCTION ADD COLUMN
    function add_column($table, $col, $property="", $position="")
    {

        $sql = "ALTER TABLE ".$table." ADD ".$col." ".$property." ".$position;
        
        error_log($sql);

        if($this->conn->query($sql)){
            return TRUE;
        }else{
            error_log("ERROR IN ADD_COLUMN : EXCECUTING SQL ERROR");
            return FALSE;
        }
    }



    function close(){
        $this->conn->close();
    }

}
?>