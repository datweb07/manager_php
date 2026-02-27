<?php

if (!defined('_AUTH')) {
    die('Truy cập không hợp lệ');
}

// truy vấn data
function get_All($sql)
{
    global $conn;

    $stm = $conn->prepare($sql);

    $stm->execute();

    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function get_One($sql)
{
    global $conn;

    $stm = $conn->prepare($sql);

    $stm->execute();

    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result;
}


// insert data
function insert_data($table, $data)
{
    global $conn;

    $keys = array_keys($data);
    $column = implode(',', $keys);
    $place_holder = ':' . implode(',:', $keys);


    $sql = "INSERT INTO $table ($column) VALUES ($place_holder)";        // :name: placeholder
    echo $sql;
    $stm = $conn->prepare($sql);      // bảo vệ khỏi tấn công như SQL Injection


    // thực thi 
    $stm->execute($data);
}



// update data
function update_data($table, $data, $condition = '')
{
    global $conn;
    $update = '';

    foreach($data as $key => $value){
        $update .= $key . ' = :' . $key . ', ';
    }

    $update = rtrim($update, ', ');

    echo $update;

    if (!empty($condition)){
        $sql = "UPDATE $table SET $update WHERE $condition";
    }
    else {
        $sql = "UPDATE $table SET $update";
    }

    $stm = $conn->prepare($sql);

    

    $stm->execute($data);
}

?>