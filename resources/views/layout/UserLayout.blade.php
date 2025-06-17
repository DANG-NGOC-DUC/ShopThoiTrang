<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Male Fashion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        .nav-link {
            color: #333;
            padding: 10px;
            border-radius: 5px;
        }

        .nav-link:hover,
        .nav-link.active {
            font-weight: bold;
            background-color: #f0f4ff;
            color: rgb(0, 0, 0);
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .tooltip-inner {
            background-color: #000 !important;
            color: #fff !important;
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 5px;
        }

        .tooltip.bs-tooltip-top .tooltip-arrow::before,
        .tooltip.bs-tooltip-bottom .tooltip-arrow::before,
        .tooltip.bs-tooltip-start .tooltip-arrow::before,
        .tooltip.bs-tooltip-end .tooltip-arrow::before {
            border-color: #000 !important;
        }

        .navbar {
            min-height: 100px;
        }

        .footer {
            background: #111111;
            margin-top: 200px;
            padding-top: 70px;
        }

        .footer__about {
            margin-bottom: 30px;
        }

        .footer__about .footer__logo {
            margin-bottom: 30px;
        }

        .footer__about .footer__logo a {
            display: inline-block;
        }

        .footer__about p {
            color: #b7b7b7;
            margin-bottom: 30px;
        }

        .footer__widget {
            margin-bottom: 30px;
        }

        .footer__widget h6 {
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .footer__widget ul li {
            line-height: 36px;
            list-style: none;
        }

        .footer__widget ul li a {
            color: #b7b7b7;
            font-size: 15px;
        }

        .footer__widget .footer__newslatter p {
            color: #b7b7b7;
        }

        .footer__widget .footer__newslatter form {
            position: relative;
        }

        .footer__widget .footer__newslatter form input {
            width: 100%;
            font-size: 15px;
            color: #3d3d3d;
            background: transparent;
            border: none;
            padding: 15px 0;
            border-bottom: 2px solid #ffffff;
        }

        .footer__widget .footer__newslatter form input::-webkit-input-placeholder {
            color: #3d3d3d;
        }

        .footer__widget .footer__newslatter form input::-moz-placeholder {
            color: #3d3d3d;
        }

        .footer__widget .footer__newslatter form input:-ms-input-placeholder {
            color: #3d3d3d;
        }

        .footer__widget .footer__newslatter form input::-ms-input-placeholder {
            color: #3d3d3d;
        }

        .footer__widget .footer__newslatter form input::placeholder {
            color: #3d3d3d;
        }

        .footer__widget .footer__newslatter form button {
            color: #b7b7b7;
            font-size: 16px;
            position: absolute;
            right: 5px;
            top: 0;
            height: 100%;
            background: transparent;
            border: none;
        }

        .footer__copyright__text {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            margin-top: 40px;
        }

        .footer__copyright__text p {
            color: #b7b7b7;
            margin-bottom: 0;
        }

        .footer__copyright__text p i {
            color: #e53637;
        }

        .footer__copyright__text p a {
            color: #e53637;
        }

        #userDropdown::after {
            color: #000000 !important;
        }
    </style>
</head>

<body>
    <!-- Header Start -->
    <header class="bg-white shadow-sm px-5 py-2 sticky-top" style="z-index: 1030;">
        <div class="container ">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-3 col-md-4 col-sm-12 mb-2 mb-md-0">
                    <a href="{{ route('user.home') }}" class="text-decoration-none">
                        <img src="{{ asset('storage/image/logo.svg') }}" width="90" height="90" alt="">
                    </a>
                </div>

                <!-- Navigation Menu -->
                <div class="col-lg-4 col-md-5 d-none d-md-block">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="{{ route('user.home') }}"
                                class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.shop') }}"
                                class="nav-link {{ request()->routeIs('user.shop') ? 'active' : '' }}">
                                Shop
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.blog') }}"
                                class="nav-link {{ request()->routeIs('user.blog') ? 'active' : '' }}">
                                Blog
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.contact') }}"
                                class="nav-link {{ request()->routeIs('user.contact') ? 'active' : '' }}">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Search + Cart + User -->
                <div class="col-lg-5 col-md-6">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <!-- Cart Icon -->
                        <a href="{{ route('user.cart') }}"
                            class="text-dark text-decoration-none d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="black"
                                class="bi bi-cart3" viewBox="0 0 16 16">
                                <path
                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg>
                        </a>

                        <!-- Search -->
                        <form class="d-flex align-items-center" role="search" method="GET"
                            action="{{ route('user.shop') }}">
                            <input class="form-control form-control-sm me-2" type="search" name="keyword"
                                placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}"
                                style="max-width: 180px; height: 28px;" required />
                            <button class="btn btn-dark btn-sm" type="submit" style="height: 32px;">Tìm</button>
                        </form>

                        <!-- User Dropdown -->
                        <div class="dropdown d-flex align-items-center">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="black"
                                    class="bi bi-person-circle me-1" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                                <span
                                    class="fw-semibold text-dark">{{ optional(Auth::user())->fullname ?? 'Guest' }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userDropdown">
                                <li><span
                                        class="dropdown-item-text text-muted">{{ optional(Auth::user())->email ?? 'example@example.com' }}</span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a href="{{ route('user.profile') }}" class="dropdown-item">Profile</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">@csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img style="width: 100px; height: 100px; background: #ffffff;"
                                    src="{{ asset('/storage/image/logo.svg') }}" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="{{ asset('/storage/image/payment.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                @csrf
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path
                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                        </svg>
                                    </span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>2020
                            All rights reserved | This template is made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Toast -->
    <div id="toast"
        style="
        visibility: hidden;
        min-width: 250px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 12px;
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;">
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.set-bg').each(function() {
                const bg = $(this).data('setbg');
                $(this).css('background-image', 'url(' + bg + ')');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-add-to-cart');
            const toast = document.getElementById('toast');

            function showToast(message) {
                toast.textContent = message;
                toast.style.visibility = 'visible';
                toast.style.opacity = 1;

                setTimeout(() => {
                    toast.style.opacity = 0;
                    setTimeout(() => {
                        toast.style.visibility = 'hidden';
                    }, 500);
                }, 3000);
            }

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.dataset.id;

                    fetch("{{ route('user.cart.add') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: 1
                            })
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Có lỗi xảy ra. Mã lỗi: ' +
                                response.status);
                            return response.json();
                        })
                        .then(data => {
                            showToast(data.message);
                        })
                        .catch(error => {
                            console.error('Lỗi fetch:', error);
                            showToast('Có lỗi xảy ra. Vui lòng thử lại!');
                        });
                });
            });
        });
    </script>
</body>

</html>
