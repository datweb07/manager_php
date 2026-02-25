<?php

const _AUTH = true;

const _HOST = 'localhost';
const _DB = 'db_manager';
const _USER = 'root';
const _PASS = '123456';
const _DRIVER = 'mysql';

const _DEBUG = true;        // debug lỗi

// thiết lập host
define('_HOST_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/manager_php');
define('_HOST_URL_TEMPLATES', 'http://' . $_SERVER['HTTP_HOST'] . '/manager_php/templates');

// thiết lập path
define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATES', __DIR__ . '/templates');
?>