<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
// echo date('Y:m:d H:i:s')

session_start();    // khởi tạo một phiên làm việc để lưu dữ liệu user
ob_start();         // tránh lỗi khi dùng các hàm như header, cookie,...

require_once './config.php';

$module = _MODULES;
$action = _ACTION;

if (!empty($_GET['module'])) {
    $module = $_GET['module'];
}
;

if (!empty($_GET['action'])) {
    $module = $_GET['action'];
}
;

$path = 'modules/' . $module . '/' . $action . '.php';

if (!empty($path)) {
    if (file_exists($path)) {
        echo 'Success connect';
        require_once $path;
    } else {
        require_once './modules/errors/404.php';
    }
} else {
    require_once './modules/errors/500.php';
}
?>