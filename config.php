<?php

// DATABASE VALUES
$servername = "localhost";
$username = "root";
$password = "";

// FUNCTION TO INSERT A ROW TO TABLE
function insert_row(...$args)
{
    // GETTING GLOBAL CONN
    global $conn;

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

    // SQL FORINSERT ROW
    $sql = "INSERT INTO " . $table . " VALUES(" . $val . ")";

    if ($conn->query($sql)) {
        return "TRUE";
    } else {
        return "FALSE" . $conn->error;
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
    //echo $sql;

    if ($conn->query($sql)) {
        return "TRUE";
    } else {
        return "FALSE" . $conn->error;
    }
}

// FUNCTION TO CHECK WHETHER A ROW EXCIST IN TABLE
function row_excist($table, $where)
{
    global $conn;

    $sql = "SELECT * FROM " . $table . " WHERE " . $where;
    // echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        // echo "yes";
        return true;
    } else {
        return false;
    }
}
