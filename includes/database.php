<?php

if (!defined('_AUTH')) {
    die('Truy cập không hợp lệ');
}

// truy vấn select *
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

?>