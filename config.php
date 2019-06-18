<?php

// DATABASE VALUES
require 'db.php';

// SETTING RESULT AS GLOBAL VARIABLE FOR USING MULTIPLE FUNCTIONS
$result;

// FUNCTION TO INSERT A ROW TO TABLE
function insert_row(...$args)
{
    // GETTING GLOBAL CONN
    global $conn;

    // SETTING COLUMNS

    // GETTING TABLE VALUE
    $table = $args[0];

    // REMOVE TABLE VALUE FROM ARRAY
    array_shift($args);

    // DECLARE VARIABLE FOR STORING TABLE VALUES
    $val = "0";
    foreach ($args as $v) {
        // STORING TABLE VALUES TO VARIABLE
        $val .= ",'" . $v . "'";
    }
    
    // SQL FOR INSERT ROW
    $sql = "INSERT INTO " . $table . " VALUES(" . $val . ")";

    if ($conn->query($sql)) {
        
        return TRUE;
    } else {
        error_log("ERROR OCCURED WHILE EXCECUTING SQL IN INSERT_ROW FUNCTION : ".$conn->error);
        return FALSE;
    }
}

// FUNCTION FOR UPDATE A ROW OF TABLE
function update_row(...$args)
{
    global $conn;

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

    if ($conn->query($sql)) {
        return "TRUE";
    } else {
        error_log("ERROR OCCURED IN UPDATE_ROW() : ".$conn->error);
        return FALSE;
    }
}

// FUNCTION TO CHECK WHETHER A ROW EXIST IN TABLE
function row_exist($table, $where)
{
    global $conn;

    $sql = "SELECT * FROM " . $table . " WHERE " . $where;

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        return TRUE;
    } else {
        error_log("ERROR OCCURED WHILE ECECUTING SQL IN ROW_EXIST FUNTION : ".$conn->error);
        return FALSE;
    }
}


// FUNCTION FOR GETTING LAST ROW
function get_last_row($table, $col)
{
    global $conn;

    $sql = "SELECT id FROM ".$table." ORDER BY id DESC LIMIT 1";
    
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            return $row[$col];
        }
    } else {
        error_log("ERROR IN GETING_LAST_ROW : RESULTING MORE THAN ONE OR NO ROWS");
        return false;
    }
}


// GET DATA OF SPECIFIC COLUMN FROM SPECIFIC TABLE
function get_data($col, $table, $db, $where="", $colToGet=FALSE){

    global $servername, $username, $password;

    // CREATE CONNECTION 
    $conn = new mysqli($servername, $username, $password, $db);
        
    // IF CONNECTION ERROR OCCURED
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $array = [];

    $sql = "SELECT ".$col." FROM ".$table." ".$where;

    if($colToGet){
        $col = $colToGet;
    }
    
    $result = $conn->query($sql);

    print_r($result);

    if ($result->num_rows >= 1) {
        while ($row = $result->fetch_assoc()) {
            array_push($array, $row[$col]);
        }

        return $array;
    } else {
        error_log("ERROR IN GET_DATA : RESULTING LESS THAN ONE OR NO ROWS");
        return false;
    }

    $conn->close();
}
