# :tshirt: Dự Án Website Quản Lý/ Mua Bán Quần Áo

## :bust_in_silhouette: Thông Tin Sinh Viên
- Họ và tên: Nguyễn Văn A
- Mã sinh viên: 12345678
- Lớp: K17_CNTT-8
- Môn học: Thiết kế Web nâng cao (COUR01.TH4)

---

## :clipboard: Giới thiệu Project

**Dự án xây dựng một website chuyên về mua bán quần áo, kết nối giữa người quản trị (admin) và người mua (user), mang đến trải nghiệm mua sắm hiện đại, tiện lợi và nhanh chóng.**

- Nhanh chóng  
- Minh bạch  
- Đáng tin cậy  

### :package: Chức năng chính

#### :crown: Chức năng của Admin:
- :bikini: Quản lý danh mục sản phẩm (thêm, sửa, xóa, tìm kiếm danh mục)
- :tshirt: Quản lý sản phẩm (thêm, sửa, xóa, tìm kiếm, phân loại sản phẩm)
- :bust_in_silhouette: Quản lý tài khoản người dùng (xem, phân quyền, sửa, xóa)
- :shopping_cart: Quản lý đơn hàng (xem, duyệt, hủy, cập nhật trạng thái)
- :bar_chart: Xem báo cáo/thống kê doanh thu, số lượng đơn hàng, sản phẩm bán chạy
- :bell: trả lời phản hồi của người dùng

#### :bust_in_silhouette: Chức năng của Người mua (User):
- :tshirt: Duyệt và tìm kiếm sản phẩm theo tên, danh mục, giá
- :handbag: Thêm sản phẩm vào giỏ hàng, cập nhật/xóa sản phẩm trong giỏ
- :credit_card: Đặt hàng, thanh toán đơn hàng
- :memo: Cập nhật thông tin cá nhân
- :bell: Nhận thông báo từ hệ thống/admin
- :email: Gửi liên hệ/góp ý tới quản trị viên và nhận phản hồi

---

## :computer: Công Nghệ Sử Dụng
1. PHP (Laravel Framework)
2. MySQL (Aiven Cloud)
3. Blade Template, HTML, CSS (Giao diện)
4. Tailwind CSS (Thiết kế responsive)

---

## 	:brain: Sơ Đồ


## 1. Sơ đồ cấu trúc (Class Diagram)

![Sơ đồ cơ sở dữ liệu](Img/readme/db.png)

**Mô tả:**  
- `User`: Quản lý thông tin người dùng, phân quyền (user/admin)
- `Product`: Quản lý sản phẩm
- `Order`: Quản lý đơn hàng
- `OrderItem`: Chi tiết sản phẩm trong đơn hàng
- `Category`: Danh mục sản phẩm
- `Contact`: Liên hệ/góp ý từ người dùng
- `ContactReply`: Phản hồi từ admin

---

## 2. Sơ đồ thuật toán (Activity Diagram)

### a. Hiển thị tất cả sản phẩm được mua bởi khách hàng

![Activity Diagram - Hiển thị sản phẩm đã mua](docs/activity-diagram-products-bought.png)

**Mô tả:**  
- Người dùng đăng nhập → Chọn xem lịch sử mua hàng → Hệ thống truy vấn các đơn hàng của user → Hiển thị danh sách sản phẩm đã mua.

### b. Tìm kiếm số lượng sản phẩm được lựa chọn nhiều nhất

![Activity Diagram - Sản phẩm được mua nhiều nhất](docs/activity-diagram-most-bought.png)

**Mô tả:**  
- Admin chọn chức năng thống kê → Hệ thống truy vấn bảng order_items, group theo product_id, đếm số lượng → Sắp xếp giảm dần → Hiển thị sản phẩm bán chạy nhất.

---

## 3. Ảnh chụp màn hình chức năng chính

### a. Trang chủ người dùng

![Trang chủ](docs/screenshot-home.png)

### b. Trang quản lý sản phẩm (Admin)

![Quản lý sản phẩm](docs/screenshot-admin-product.png)

### c. Trang giỏ hàng

![Giỏ hàng](docs/screenshot-cart.png)

### d. Trang liên hệ và phản hồi

![Liên hệ](docs/screenshot-contact.png)

---

## 4. Code minh họa phần chính project

### a. Truy vấn sản phẩm được mua nhiều nhất

```php
// Lấy sản phẩm được mua nhiều nhất
use App\Models\OrderItem;
use App\Models\Product;

$topProducts = OrderItem::select('product_id', \DB::raw('SUM(quantity) as total'))
    ->groupBy('product_id')
    ->orderByDesc('total')
    ->take(5)
    ->with('product')
    ->get();
```
