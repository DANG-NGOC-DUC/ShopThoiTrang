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
- :bell: Trả lời phản hồi của người dùng

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

## :brain: Sơ Đồ

### :file_cabinet: Sơ đồ cơ sở dữ liệu

![Sơ đồ cơ sở dữ liệu](Img/db.png)

#### 1. Các bảng chính

- **users**  
  Lưu thông tin tài khoản người dùng (admin và user): tên, email, mật khẩu, thời gian tạo/cập nhật, v.v.
- **categories**  
  Quản lý danh mục sản phẩm (ví dụ: áo, quần, váy...).
- **products**  
  Lưu thông tin sản phẩm: tên, mô tả, giá, hình ảnh, thuộc danh mục nào.
- **carts**  
  Đại diện cho giỏ hàng của từng user.
- **cart_items**  
  Lưu chi tiết các sản phẩm trong từng giỏ hàng (sản phẩm nào, số lượng bao nhiêu).
- **orders**  
  Lưu thông tin đơn hàng của người dùng: tổng tiền, trạng thái, thời gian đặt hàng.
- **order_details**  
  Lưu chi tiết từng sản phẩm trong đơn hàng (sản phẩm nào, số lượng, giá tại thời điểm đặt).
- **sessions**  
  Quản lý phiên đăng nhập của người dùng.
- **contacts**  
  Lưu các phản hồi/góp ý/liên hệ từ người dùng gửi tới admin.

#### 2. Mối quan hệ giữa các bảng

- **users** 1---n **carts**: Mỗi user có thể có nhiều giỏ hàng (thường chỉ 1 giỏ hàng đang hoạt động).
- **carts** 1---n **cart_items**: Mỗi giỏ hàng có nhiều sản phẩm.
- **products** 1---n **cart_items**: Một sản phẩm có thể nằm trong nhiều giỏ hàng khác nhau.
- **categories** 1---n **products**: Một danh mục có nhiều sản phẩm.
- **users** 1---n **orders**: Một user có thể đặt nhiều đơn hàng.
- **orders** 1---n **order_details**: Một đơn hàng có nhiều sản phẩm.
- **products** 1---n **order_details**: Một sản phẩm có thể xuất hiện trong nhiều đơn hàng.
- **users** 1---n **contacts**: Một user có thể gửi nhiều liên hệ/góp ý.
- **users** 1---n **sessions**: Một user có thể có nhiều phiên đăng nhập.

### :pushpin: Sơ đồ cấu trúc (Class Diagram)

![Sơ đồ cấu trúc](Img/class.png)

### :pushpin: Sơ đồ thuật toán

- Admin quản lý sản phẩm (CRUD)  
  ![Quản lý sản phẩm](Img/QuanLySanPham.png)
- Admin quản lý tài khoản (CRUD)  
  ![Quản lý tài khoản](Img/QuanLyTaiKhoan.png)
- Admin quản lý danh sách đơn hàng  
  ![Quản lý danh sách đơn hàng](Img/QuanLyDanhSachDonHang.png)
- User xem sản phẩm  
  ![User xem sản phẩm](Img/UserXemSanPham.png)
- User mua hàng, đặt hàng, thanh toán  
  ![User mua hàng](Img/UserMuaHang.png)
- User gửi liên hệ  
  ![User gửi liên hệ](Img/UserGuiLienHe.png)

---

## :gear: Cài Đặt

```sh
# 1. Clone Repository
git clone https://github.com/DANG-NGOC-DUC/ShopThoiTrang.git
cd ShopThoiTrang/BanHang

# 2. Cài Đặt Dependencies PHP
composer install

# 3. Cấu Hình Environment
cp .env.example .env
php artisan key:generate

# 4. Khởi Động Development Server
php artisan serve
```


