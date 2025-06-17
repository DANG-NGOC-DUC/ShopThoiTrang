@extends('layout.UserLayout')

@section('content')
    <!-- Thông báo toast khi thêm vào giỏ hàng thành công -->
    <div id="toast-add-cart" class="position-fixed top-0 end-0 p-3" style="z-index: 2000; display: none;">
        <div class="toast align-items-center text-bg-dark border-0 show" role="alert">
            <div class="d-flex">
                <div class="toast-body text-white">
                    Đã thêm sản phẩm vào giỏ hàng!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="hideToast()"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('user.shop') }}">
        @csrf
        <div class="container">
            <div class="row">
                <!-- Sidebar bên trái -->
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <!-- Danh mục -->
                                <div class="card">
                                    <div class="card-heading ">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                @php
                                                    $selectedCategories = request('category', []);
                                                @endphp

                                                @foreach ($categories as $category)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="category[]"
                                                            value="{{ $category->id }}" id="cat{{ $category->id }}"
                                                            {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="cat{{ $category->id }}">
                                                            {{ $category->name }} ({{ $category->products_count }})
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lọc theo giá -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                @php
                                                    $priceRanges = [
                                                        '0-200000' => 'Dưới 200.000 VNĐ',
                                                        '200000-400000' => '200.000 - 400.000 VNĐ',
                                                        '400000-600000' => '400.000 - 600.000 VNĐ',
                                                        '600000-999999999' => 'Trên 600.000 VNĐ',
                                                    ];
                                                    $selectedPrices = request('price', []);
                                                @endphp

                                                @foreach ($priceRanges as $value => $label)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="price[]"
                                                            value="{{ $value }}" id="price{{ $loop->index }}"
                                                            {{ in_array($value, $selectedPrices) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="price{{ $loop->index }}">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- /.accordion -->
                        </div>
                    </div>
                </div>

                <!-- Sản phẩm bên phải -->
                <div class="col-lg-9">
                    <section class="product spad">
                        <div class="row product__filter">
                            @foreach ($products as $index => $product)
                                @php
                                    $isNew = $index == 0;
                                    $isSale = in_array($index, [2, 5]);
                                    $rating = $isSale ? 4 : 0;
                                @endphp

                                <div
                                    class="col-lg-4 col-md-6 col-sm-6 mix {{ $index % 2 == 0 ? 'hot-sales' : 'new-arrivals' }}">
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <a href="#" class="product-image-link" data-bs-toggle="modal"
                                                data-bs-target="#productModal" data-title="{{ $product->title }}"
                                                data-price="{{ number_format($product->price) }} VNĐ"
                                                data-thumbnail="{{ asset('storage/' . $product->thumbnail) }}"
                                                data-description="{{ $product->description ?? 'Không có mô tả' }}">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                    alt="{{ $product->title }}">
                                            </a>

                                        </div>
                                        <div class="product__item__text">
                                            <h6>{{ $product->title }}</h6>
                                            <a href="javascript:void(0)" class="btn-add-to-cart text-danger fw-bold"
                                                data-id="{{ $product->id }}">+ Add To Cart</a>
                                            <div class="rating">

                                            </div>
                                            <h5>{{ number_format($product->price) }} VNĐ</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center pagination">
                            {{ $products->links() }}
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </form>
    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body d-flex flex-wrap align-items-start gap-4">
                    <div class="me-4">
                        <img id="modalProductImage" src="" alt="" class="img-fluid rounded border shadow-sm"
                            style="max-width: 250px;">

                    </div>
                    <div>
                        <h4 id="modalProductTitle"></h4>
                        <h5 id="modalProductPrice" class="text-danger fw-bold"></h5>
                        <p id="modalProductDescription" class="mt-3"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.product-image-link');
            const modalTitle = document.getElementById('modalProductTitle');
            const modalPrice = document.getElementById('modalProductPrice');
            const modalImage = document.getElementById('modalProductImage');
            const modalDescription = document.getElementById('modalProductDescription');

            links.forEach(link => {
                link.addEventListener('click', function() {
                    modalTitle.textContent = this.dataset.title;
                    modalPrice.textContent = this.dataset.price;
                    modalImage.src = this.dataset.thumbnail;
                    modalDescription.textContent = this.dataset.description;
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    cb.closest('form').submit();
                });
            });
        });
    </script>
    <script>
        // Xử lý nút Add To Cart
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-add-to-cart').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var productId = this.getAttribute('data-id');
                    fetch('/user/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId, quantity: 1 })
                    })
                    .then(response => response.json())
                    .then(data => {
                        showToast();
                    });
                });
            });
        });

        function showToast() {
            var toast = document.getElementById('toast-add-cart');
            toast.style.display = 'block';
            setTimeout(hideToast, 2000);
        }
        function hideToast() {
            var toast = document.getElementById('toast-add-cart');
            toast.style.display = 'none';
        }
    </script>
    <!-- CSS -->
    <style>
        /* Custom pagination */
.pagination {
    margin-top: 30px;
}

.pagination .page-item .page-link {
    color: #ae1d57;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 6px;
    padding: 8px 16px;
    font-weight: 600;
    transition: background 0.2s, color 0.2s;
}

.pagination .page-item.active .page-link {
    background: #ae1d57;
    color: #fff;
    border-color: #ae1d57;
}

.pagination .page-item .page-link:hover {
    background: #f8e6ef;
    color: #ae1d57;
}
        .card-heading {
            font-size: 25px;
            color: #ae1d57
        }

        .shop__sidebar {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #fff;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            position: sticky;
            top: 100px;
            /* khoảng cách từ top khi dính */
            height: fit-content;
        }

        .shop__sidebar li {
            list-style-type: disc;
            margin-bottom: 8px;
            padding-left: 20px;
        }

        .shop__sidebar li a {
            text-decoration: none;
            color: #444;
            font-size: 14px;
            transition: color 0.2s;
        }

        .sidebar-list li a:hover {
            color: #7fad39;
        }

        .product {
            margin-top: 60px;
            padding-bottom: 60px;
        }

        .filter__controls {
            text-align: center;
            margin-bottom: 45px;
        }

        .filter__controls li {
            color: #b7b7b7;
            font-size: 24px;
            font-weight: 700;
            display: inline-block;
            margin-right: 88px;
            cursor: pointer;
        }

        .filter__controls li.active {
            color: #111111;
        }

        .product__item {
            overflow: hidden;
            margin-bottom: 40px;
        }

        .product__item__pic {
            height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            overflow: hidden;
        }

        .product__item__pic img {
            max-width: 80%;
            /* hoặc px như max-width: 300px; */
            max-height: 80%;
            /* hoặc px như max-height: 300px; */
            object-fit: contain;
            display: block;
            /* tránh khoảng trắng dưới ảnh */
            margin: 0 auto;
            /* canh giữa nếu muốn */
        }


        .product__item__text {
            padding-top: 25px;
            position: relative;
        }

        .product__item__text a {
            font-size: 15px;
            color: #e53637;
            font-weight: 700;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .product__item__text h6 {
            color: #111111;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        .product__item__text .rating {
            margin-bottom: 6px;
        }

        .product__item__text .rating i {
            font-size: 14px;
            color: #b7b7b7;
            margin-right: -5px;
        }

        .product__item__text h5 {
            color: #0d0d0d;
            font-weight: 700;
        }

        .product__item:hover .product__item__text a {
            top: 22px;
            opacity: 1;
            visibility: visible;
        }

        .product__item:hover .product__item__text h6 {
            opacity: 0;
        }

        /* CUSTOM RADIO BUTTON */
        .custom-radio {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            border: 2px solid #bbb;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            margin-right: 10px;
            vertical-align: middle;
        }

        .custom-radio:checked {
            border-color: #007bff;
            background-color: #007bff;
        }

        .custom-radio:checked::after {
            content: "";
            width: 8px;
            height: 8px;
            background: #fff;
            border-radius: 50%;
            position: absolute;
            top: 4px;
            left: 4px;
        }

        .form-check-label {
            font-weight: 500;
            color: #555;
            cursor: pointer;
        }

        .form-check:hover .form-check-label {
            color: #007bff;
        }
    </style>
@endsection
