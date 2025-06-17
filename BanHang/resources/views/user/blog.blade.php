@extends('layout.UserLayout')
@section('title', 'Blog')
@section('content')
    <!-- Blog Slider Begin -->
    <section class="blog-slider">
        <div class="slider-overlay">
            <p>Our Blog</p>
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @for ($i = 1; $i <= 9; $i++)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/blog/blog-' . $i . '.jpg') }}" alt="Blog {{ $i }}">
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <!-- Blog Slider End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @for ($i = 1; $i <= 9; $i++)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic-wrapper">
                                <img src="{{ asset("storage/blog/blog-$i.jpg") }}" alt="Blog {{ $i }}">
                                <div class="blog__item__text">
                                    <span>
                                        <i class="fa fa-calendar"></i>
                                        @php
                                            echo match ($i % 3) {
                                                1 => '16 February 2020',
                                                2 => '21 February 2020',
                                                default => '28 February 2020',
                                            };
                                        @endphp
                                    </span>
                                    <h5>
                                        @php
                                            echo match ($i) {
                                                1 => 'What Curling Irons Are The Best Ones',
                                                2 => 'Eternity Bands Do Last Forever',
                                                3 => 'The Health Benefits Of Sunglasses',
                                                4 => 'Aiming For Higher The Mastopexy',
                                                5 => 'Wedding Rings A Gift For A Lifetime',
                                                6 => 'The Different Methods Of Hair Removal',
                                                7 => 'Hoop Earrings A Style From History',
                                                8, 9 => 'Lasik Eye Surgery Are You Ready',
                                            };
                                        @endphp
                                    </h5>
                                    <a href="#">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    </section>

    <!-- Blog Section End -->
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".mySwiper", {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                speed: 800,
            });
        });
    </script>

    <style>
        .blog-slider {
            position: relative;
            width: 100%;
            height: 300px;
            margin-bottom: 40px;
            overflow: hidden;
        }

        .slider-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 2;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            font-size: 75px;
            /* co dãn theo chiều ngang màn hình */
            font-weight: bold;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.6);
            pointer-events: none;
            line-height: 1;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Giúp ảnh lấp đầy vùng chứa và giữ tỉ lệ */
            object-position: center;
            /* Lấy tâm ảnh làm điểm chính */
        }

        /* Lấy tâm ảnh làm điểm chính */



        .blog__item {
            position: relative;
            margin-bottom: 45px;
            overflow: hidden;
            overflow: visible;
            border-radius: 8px;
            margin-bottom: 100px;
        }

        .blog__item__pic-wrapper {
            position: relative;
            overflow: visible;
        }

        .blog__item__pic-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }

        .blog__item__text {
            position: absolute;
            bottom: -60px;              /* Lùi xuống thêm một chút từ đáy */
            left: 50%;
            transform: translateX(-50%);
            width: 70%;                /* Thu hẹp chiều ngang khối trắng */
            padding: 15px 20px;        /* Giảm padding cho gọn */
            background: #fff;
            box-shadow: 0px 15px 60px rgba(67, 69, 70, 0.1);
            border-radius: 10px;
            transition: all 0.3s;
        }

        .blog__item__text span {
            color: #3d3d3d;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
        }

        .blog__item__text h5 {
            color: #0d0d0d;
            font-weight: 700;
            line-height: 26px;
            font-size: 17px;
            margin-bottom: 10px;
        }

        .blog__item__text a {
            display: inline-block;
            color: #111111;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            position: relative;
            text-decoration: none;
        }

        .blog__item__text a:after {
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background: #111111;
            content: "";
            transition: all 0.3s;
        }

        .blog__item:hover .blog__item__text a:after {
            width: 40px;
            background: #e53637;
        }
    </style>
@endsection
