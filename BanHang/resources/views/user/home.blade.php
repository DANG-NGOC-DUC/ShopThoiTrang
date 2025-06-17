@extends('layout.UserLayout')

@section('content')

<!-- Thông báo toast khi thêm vào giỏ hàng thành công -->
<div id="toast-add-cart" class="position-fixed top-0 end-0 p-3" style="z-index: 2000; display: none;">
    <div class="toast align-items-center text-bg-dark border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body text-white">
                Đã thêm sản phẩm vào giỏ hàng!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="hideToast()" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Hero Carousel Start -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active"
             style="background-image: url('{{ asset('storage/image/hero-1.jpg') }}'); background-size: cover; background-position: center; min-height: 600px;">
            <section class="hero-section d-flex align-items-center" style="min-height: 600px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-black" style="text-shadow: 1px 1px 2px rgba(255,255,255,0.7);">
                            <p class="text-danger fw-bold text-uppercase animate-slide-in">Summer Collection</p>
                            <h1 class="display-4 fw-bold animate-slide-in delay-1s">
                                Fall - Winter<br>Collections 2025
                            </h1>
                            <p class="animate-slide-in delay-2s">
                                A specialist label creating luxury essentials. Ethically crafted<br>
                                with an unwavering commitment to exceptional quality.
                            </p>
                            <button onclick="window.location.href='{{ route('user.shop') }}'" 
                                    class="btn btn-dark px-4 py-2 mt-3 btn-hover-animate">
                                Shop Now
                            </button>
                    </div>
                </div>
            </section>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item"
             style="background-image: url('{{ asset('storage/image/hero-2.jpg') }}'); background-size: cover; background-position: center; min-height: 600px;">
            <section class="hero-section d-flex align-items-center" style="min-height: 600px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-black" style="text-shadow: 1px 1px 2px rgba(255,255,255,0.7);">
                            <p class="text-danger fw-bold text-uppercase animate-slide-in">Summer Collection</p>
                            <h1 class="display-4 fw-bold animate-slide-in delay-1s">
                                Fall - Winter<br>Collections 2025
                            </h1>
                            <p class="animate-slide-in delay-2s">
                                A specialist label creating luxury essentials. Ethically crafted<br>
                                with an unwavering commitment to exceptional quality.
                            </p>
                            <button onclick="window.location.href='{{ route('user.shop') }}'" 
                                    class="btn btn-dark px-4 py-2 mt-3 btn-hover-animate">
                                Shop Now
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

</div>
<!-- Hero Carousel End -->


<!-- Featured Categories Section Start -->
<section class="banner spad mt-5">
    <div class="container">
        <div class="row">
            <!-- Empty column (để clothing lệch sang phải) -->
            <div class="col-lg-5"></div>

            <!-- Clothing (trên bên phải) -->
            <div class="col-lg-7">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ asset('storage/banner/banner-1.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2025</h2>
                        <a href="{{ route('user.shop') }}">Shop now</a>
                    </div>
                </div>
            </div>

            <!-- Accessories (dưới bên trái) -->
            <div class="col-lg-5 mt-4">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="{{ asset('storage/banner/banner-2.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Accessories</h2>
                        <a href="{{ route('user.shop') }}">Shop now</a>
                    </div>
                </div>
            </div>

            <!-- Shoes (dưới bên phải) -->
            <div class="col-lg-7 mt-4">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="{{ asset('storage/banner/banner-3.jpg') }}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Shoes Spring 2025</h2>
                        <a href="{{ route('user.shop') }}">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Featured Categories Section End -->
 <!-- Product Section Begin -->
 <section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach ($products as $index => $product)
                @php
                    $isNew = $index == 0;
                    $isSale = in_array($index, [2, 5]);
                    $rating = $isSale ? 4 : 0;
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-6 mix {{ $index % 2 == 0 ? 'hot-sales' : 'new-arrivals' }}">
                    <div class="product__item">
                        <div class="product__item__pic">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->title }}">
                        </div>
                        <div class="product__item__text">
                            <h6>{{ $product->title }}</h6>
                            <a href="javascript:void(0)" class="btn-add-to-cart text-danger fw-bold" data-id="{{ $product->id }}">+ Add To Cart</a>
                            <div class="rating">
                            </div>
                            <h5>{{ number_format($product->price) }} VNĐ</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->

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

<!-- Custom Styles -->
<style>
/* Product Section */
.product {
    margin-top: 60px;
    padding-top: 0;
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
    list-style: none;
    display: inline-block;
    margin-right: 88px;
    cursor: pointer;
}

.filter__controls li:last-child {
    margin-right: 0;
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
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background-color: #f9f9f9;
}

.product__item__pic img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
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


    /*  */
    .blog {
        padding-bottom: 55px;
    }

    .banner__item {
        position: relative;
        overflow: hidden;
    }

    .banner__item:hover .banner__item__text a:after {
        width: 40px;
        background: #e53637;
    }

    .banner__item.banner__item--middle {
        margin-top: -75px;
    }

    .banner__item.banner__item--middle .banner__item__pic {
        float: none;
    }

    .banner__item.banner__item--middle .banner__item__text {
        position: relative;
        top: 0;
        left: 0;
        max-width: 100%;
        padding-top: 22px;
    }

    .banner__item.banner__item--last {
        margin-top: 100px;
    }

    .banner__item__pic {
        float: right;
    }

    .banner__item__text {
        max-width: 300px;
        position: absolute;
        left: 0;
        top: 140px;
    }

    .banner__item__text h2 {
        color: #111111;
        font-weight: 700;
        line-height: 46px;
        margin-bottom: 10px;
    }

    .banner__item__text a {
        display: inline-block;
        color: #111111;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        padding: 3px 0;
        position: relative;
         text-decoration: none; 
    }

    .banner__item__text a:after {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background: #111111;
        content: "";
        transition: all 0.3s;
    }

    /* === Hero Animation === */
    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-50px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    .animate-slide-in {
        animation: slideIn 1s ease forwards;
        opacity: 0;
    }

    .delay-1s { animation-delay: 0.5s; }
    .delay-2s { animation-delay: 1s; }

    /* === Button Hover === */
    .btn-hover-animate {
        display: inline-block; /* Đảm bảo nút chiếm vùng đầy đủ */
        width: auto;           /* Hoặc width: 100% nếu cần full chiều ngang */
        transition: transform 0.15s ease, box-shadow 0.15s ease;
        padding: 0.75rem 1.5rem; /* Đảm bảo vùng nút đủ rộng và cao */
    }

    .btn-hover-animate:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    }

    /* === Carousel Arrows === */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: drop-shadow(0 0 1px rgba(0,0,0,0.7));
    }
</style>

@endsection
