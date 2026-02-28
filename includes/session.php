<?php

if (!defined('_AUTH')) {
    die('Truy cập không hợp lệ');
}


// set session
function setSession($key, $value)
{
    if (!empty(session_id())) {
        $_SESSION[$key] = $value;
        return true;
    }
    return false;
}


// get session
function getSession($key = '')
{
    if (empty($key)) {
        return $_SESSION;
    } else {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }
    return false;
}


// delete session
function deleteSession($key)
{
    if (empty($key)) {
        session_destroy();
        return true;
    } else {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
        return true;
    }
    return false;
}


// set session flash
function setSessionFlash($key, $value){
    $key = $key . 'Flash';

    $res = setSession($key, $value);
    return $res;
}


function getSessionFlash($key){
    $key = $key . 'Flash';
    $res = getSession($key);
    deleteSession($key);
    return $res;
}

?>