# Coffee Shop POS (Laravel)

Ứng dụng quản lý quán cà phê đơn giản, gồm quản lý sản phẩm, bán hàng tại quầy (POS), quản lý đơn hàng và dashboard thống kê cơ bản.

## Công nghệ sử dụng

- Backend: Laravel (PHP)
- Frontend: Blade + Tailwind CSS + JavaScript
- Build tool: Vite
- CSDL: MySQL (quản lý qua migration)

## Chức năng hiện có

### 1) Xác thực
- Đăng nhập / đăng xuất.
- Các trang nghiệp vụ nằm trong middleware `auth`.

### 2) Dashboard
- Doanh thu hôm nay.
- Doanh thu tháng hiện tại.
- Số lượng đơn hàng hôm nay.

### 3) Quản lý sản phẩm
- Thêm / sửa / xóa mềm sản phẩm.
- Tìm kiếm sản phẩm theo tên.
- Quản lý trạng thái bán (`is_active`).
- Upload ảnh món vào thư mục storage public.

### 4) POS (bán hàng)
- Hiển thị danh sách món đang bán (`is_active = true`).
- Tạo đơn hàng từ giỏ hàng.
- Lưu `orders` và `order_details` bằng transaction.

### 5) Quản lý đơn hàng
- Danh sách đơn hàng mới nhất.
- Xem chi tiết từng đơn (món, số lượng, đơn giá).

## Cấu trúc dữ liệu chính

- `users`
- `products` (có soft deletes)
- `orders`
- `order_details`

## Lưu ý hiện trạng

- Khi checkout, `user_id` đang gán cố định là `1` trong code POS.
- Chưa có phân quyền vai trò (admin/staff) chính thức.

## Cài đặt và chạy dự án (Windows/PowerShell)

1. Cài dependency PHP:
   - `composer install`
2. Cài dependency frontend:
   - `npm install`
3. Tạo file môi trường và app key:
   - `copy .env.example .env`
   - `php artisan key:generate`
4. Cấu hình DB trong `.env`, sau đó migrate:
   - `php artisan migrate`
5. Link storage public:
   - `php artisan storage:link`
6. Chạy ứng dụng:
   - `php artisan serve`
   - `npm run dev`

## Tạo tài khoản admin bằng code

`php artisan tinker --execute 'App\Models\User::updateOrCreate(["email"=>"huytrinh548@gmail.com"],["name"=>"Admin","password"=>Illuminate\Support\Facades\Hash::make("Huycm@123")]);'`