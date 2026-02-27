<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
// echo date('Y:m:d H:i:s')

session_start();    // khởi tạo một phiên làm việc để lưu dữ liệu user
ob_start();         // tránh lỗi khi dùng các hàm như header, cookie,...

require_once './config.php';
require_once './includes/connect.php';
require_once './includes/database.php';

$data = [
    'name' => 'dat - new insert',
    'slug' => 'dat-web - new insert'
];

// get_All("select * from course");
// insert_data('course_category', $data);
// update_data('course_category', $data, 'id = 1');
// delete_data('course_category', 'id = 2');
// $res = getRows("select * from course_category");
// echo $res;

$lastQur = last_query();
echo $lastQur;


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
        // echo 'Successful connection';
        require_once $path;
    } else {
        require_once './modules/errors/404.php';
    }
} else {
    require_once './modules/errors/500.php';
}
?>