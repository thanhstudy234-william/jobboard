# JobBoard – Website tuyển dụng việc làm trực tuyến

Đồ án Web – Trường Đại học Kinh doanh và Công nghệ Hà Nội.
Xây dựng bằng **Laravel 13**, **PHP 8.3**, **SQL Server 2022**, Blade + Tailwind CSS.

## Chức năng

| Vai trò | Chức năng |
|---|---|
| Khách | Xem, tìm kiếm, lọc việc làm (từ khóa, ngành, địa điểm), xem chi tiết tin, đăng ký, đăng nhập, gửi liên hệ |
| Ứng viên | Nộp đơn kèm CV PDF, lưu / bỏ lưu việc làm, xem lịch sử và trạng thái đơn, dashboard |
| Nhà tuyển dụng | Thêm, sửa, xóa tin; xem hồ sơ ứng viên, tải CV, đổi trạng thái đơn; dashboard |
| Admin | Duyệt tin, khóa / mở khóa người dùng, quản lý danh mục, xem liên hệ, dashboard thống kê |

Điểm kỹ thuật: phân quyền 3 vai trò bằng middleware, kiểm duyệt tin (pending → approved), chống nộp trùng đơn (UNIQUE), upload CV, phân trang, validation.

## Yêu cầu

- PHP 8.3 (bật extension: curl, fileinfo, mbstring, openssl, zip, **pdo_sqlsrv**, **sqlsrv**)
- ODBC Driver 17 hoặc 18 for SQL Server
- Composer, Node.js (LTS)
- SQL Server (bản Express) bật đăng nhập SQL và TCP/IP cổng 1433

## Cài đặt

```bash
git clone https://github.com/thanhstudy234-william/jobboard.git
cd jobboard
composer install
npm install
npm run build
cp .env.example .env        # Windows: copy .env.example .env
php artisan key:generate
```

1. Tạo database rỗng trong SSMS: `CREATE DATABASE jobboard;`
2. Mở `.env`, điền `DB_PASSWORD` (mật khẩu tài khoản `sa`).
3. Chạy migration, dữ liệu mẫu và liên kết thư mục lưu file:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Mở http://127.0.0.1:8000

> Nếu gặp lỗi chứng chỉ SSL với ODBC Driver 18, đặt `'trust_server_certificate' => true` trong mục `sqlsrv` của `config/database.php` (đã cấu hình sẵn).

## Tài khoản mẫu (mật khẩu: `12345678`)

| Vai trò | Email |
|---|---|
| Admin | admin@test.com |
| Nhà tuyển dụng | employer1@test.com, employer2@test.com |
| Ứng viên | candidate1@test.com, candidate2@test.com, candidate3@test.com |

## Cơ sở dữ liệu

7 bảng: `users`, `companies`, `categories`, `job_posts`, `applications`, `saved_jobs`, `contacts`.

- users 1–1 companies, companies 1–N job_posts, categories 1–N job_posts
- job_posts 1–N applications, users 1–N applications
- users N–N job_posts qua saved_jobs

Bảng tin tuyển dụng đặt tên `job_posts` để không trùng bảng `jobs` (hàng đợi) của Laravel.

## Cấu trúc chính

```
app/Http/Controllers/        HomeController, ApplicationController, SavedJobController, ContactController, DashboardController
app/Http/Controllers/Admin/  Duyệt tin, người dùng, danh mục, liên hệ
app/Http/Controllers/Employer/  Quản lý tin, hồ sơ ứng viên
app/Http/Middleware/RoleMiddleware.php   Phân quyền theo vai trò
database/migrations/         Cấu trúc 7 bảng
database/seeders/            Dữ liệu mẫu
resources/views/             Giao diện Blade
```

## Hạn chế và hướng phát triển

- Chưa có trang chỉnh sửa hồ sơ công ty, chưa gửi email thông báo, chưa deploy.
- Hướng phát triển: hồ sơ công ty và logo, email thông báo, biểu đồ thống kê, REST API.