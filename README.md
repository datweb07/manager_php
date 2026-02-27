# Manager PHP

Ứng dụng quản lý dữ liệu xây dựng bằng PHP thuần, sử dụng PDO để kết nối MySQL. Dự án được tổ chức theo mô hình module hóa, có hệ thống định tuyến đơn giản thông qua tham số URL.

---

## Yêu cầu hệ thống

- PHP >= 8.2
- MySQL >= 8.0
- XAMPP (hoặc môi trường tương đương có Apache + MySQL)
- phpMyAdmin (không bắt buộc, hỗ trợ nhập SQL)

---

## Cài đặt

**1. Sao chép dự án vào thư mục XAMPP**

```
C:\xampp\htdocs\manager_php
```

**2. Tạo cơ sở dữ liệu**

Mở phpMyAdmin, tạo database tên `db_manager`, sau đó nhập file:

```
db_manager.sql
```

**3. Cấu hình kết nối**

Mở file `config.php` và chỉnh sửa thông tin theo môi trường của bạn:

```php
const _HOST = 'localhost';
const _DB   = 'db_manager';
const _USER = 'root';
const _PASS = '123456';
```

**4. Khởi động ứng dụng**

Bật Apache và MySQL trong XAMPP Panel, sau đó truy cập:

```
http://localhost/manager_php
```

---

## Cấu trúc thư mục

```
manager_php/
├── config.php              # Hằng số cấu hình toàn cục (DB, URL, path)
├── index.php               # Điểm vào chính, xử lý định tuyến
├── routes.php              # Định nghĩa các tuyến đường (đang phát triển)
├── db_manager.sql          # File SQL khởi tạo cơ sở dữ liệu
│
├── includes/               # Thư viện dùng chung
│   ├── connect.php         # Khởi tạo kết nối PDO
│   ├── database.php        # Các hàm truy vấn CRUD
│   ├── functions.php       # Hàm tiện ích chung
│   └── session.php         # Quản lý phiên làm việc
│
├── modules/                # Các module chức năng
│   ├── auth/               # Xác thực người dùng
│   ├── dashboard/          # Trang tổng quan
│   ├── users/              # Quản lý người dùng
│   ├── groups/             # Quản lý nhóm
│   ├── course/             # Quản lý khóa học
│   ├── course_category/    # Quản lý danh mục khóa học
│   ├── students/           # Quản lý học viên
│   └── errors/             # Xử lý lỗi (404, 500, DB, exception)
│
└── templates/              # Giao diện
    ├── layouts/            # Header, footer chung
    ├── assets/             # CSS, JS, font, image
    └── uploads/            # File tải lên
```

---

## Cơ sở dữ liệu

Database tên `db_manager` gồm các bảng sau:

| Bảng              | Mô tả                                                                          |
|-------------------|--------------------------------------------------------------------------------|
| `users`           | Người dùng: tên, email, điện thoại, địa chỉ, quyền, nhóm, trạng thái kích hoạt |
| `groups`          | Nhóm người dùng                                                                |
| `course`          | Khóa học: tên, slug, danh mục, mô tả, giá, ảnh đại diện                        |
| `course_category` | Danh mục khóa học                                                              |
| `token_login`     | Token đăng nhập (ghi nhớ đăng nhập / quên mật khẩu)                            |

Quan hệ:
- `users.group_id` tham chiếu `groups.id`
- `course.category_id` tham chiếu `course_category.id`
- `token_login.user_id` tham chiếu `users.id`

---

## Hệ thống định tuyến

Ứng dụng định tuyến theo tham số GET trên URL:

```
http://localhost/manager_php?module={module}&action={action}
```

Ví dụ:

```
?module=auth&action=login          -> modules/auth/login.php
?module=users&action=list          -> modules/users/list.php
?module=course&action=add          -> modules/course/add.php
```

Mặc định khi không có tham số: `module=dashboard`, `action=index`.

---

## Các module

### Auth - Xác thực

| File                    | Chức năng                          |
|-------------------------|------------------------------------|
| `login.php`             | Đăng nhập                          |
| `register.php`          | Đăng ký tài khoản                  |
| `active.php`            | Kích hoạt tài khoản qua email      |
| `forgot_password.php`   | Yêu cầu đặt lại mật khẩu           |
| `reset_password.php`    | Đặt lại mật khẩu bằng token        |
| `change_password.php`   | Đổi mật khẩu khi đã đăng nhập      |

### Users - Quản lý người dùng

| File             | Chức năng              |
|------------------|------------------------|
| `list.php`       | Danh sách người dùng   |
| `add.php`        | Thêm người dùng mới    |
| `edit.php`       | Chỉnh sửa người dùng   |
| `delete.php`     | Xóa người dùng         |
| `permission.php` | Phân quyền người dùng  |

### Groups - Quản lý nhóm

CRUD đầy đủ: `list`, `add`, `edit`, `delete`.

### Course - Quản lý khóa học

CRUD đầy đủ: `list`, `add`, `edit`, `delete`.

### Course Category - Danh mục khóa học

CRUD đầy đủ: `list`, `add`, `edit`, `delete`.

### Students - Học viên

Trang quản lý học viên (đang phát triển).

### Dashboard

Trang tổng quan sau khi đăng nhập.

---

## Các hàm database (`includes/database.php`)

| Hàm                                      | Mô tả                             |
|------------------------------------------|-----------------------------------|
| `get_All($sql)`                          | Lấy tất cả bản ghi                |
| `get_One($sql)`                          | Lấy một bản ghi                   |
| `getRows($sql)`                          | Đếm số lượng bản ghi              |
| `insert_data($table, $data)`             | Thêm bản ghi mới                  |
| `update_data($table, $data, $condition)` | Cập nhật bản ghi                  |
| `delete_data($table, $condition)`        | Xóa bản ghi                       |
| `last_query()`                           | Lấy ID của bản ghi vừa insert     |

Tất cả truy vấn đều dùng PDO Prepared Statements để chống SQL Injection.

---

## Xử lý lỗi

| File                            | Mô tả                        |
|---------------------------------|------------------------------|
| `modules/errors/404.php`        | Không tìm thấy trang         |
| `modules/errors/500.php`        | Lỗi máy chủ                  |
| `modules/errors/database.php`   | Lỗi kết nối cơ sở dữ liệu   |
| `modules/errors/exceptions.php` | Ngoại lệ hệ thống            |

---

## Bảo mật

- Mỗi file module đều kiểm tra hằng số `_AUTH` trước khi chạy; truy cập trực tiếp sẽ bị từ chối.
- PDO Prepared Statements được dùng xuyên suốt để chống SQL Injection.
- Token kích hoạt tài khoản và đặt lại mật khẩu lưu trong bảng `users` và `token_login`.

---

## Môi trường phát triển

- PHP 8.2.12
- MySQL 8.0.44
- XAMPP (phpMyAdmin 5.2.1)
- Múi giờ: Asia/Ho_Chi_Minh (UTC+7)
- Mã hoá ký tự: utf8mb4 / utf8mb4_unicode_ci