<?php

date_default_timezone_set('Asia/Ho_Chi_Minh');
// echo date('Y:m:d H:i:s')

session_start();    // khởi tạo một phiên làm việc để lưu dữ liệu user
ob_start();         // tránh lỗi khi dùng các hàm như header, cookie,...

require_once './config.php';

// require_once './modules/auth/login.php';
?>