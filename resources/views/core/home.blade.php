@extends('layouts.main')

@section('title', 'الصفحة الرئيسية - ShopGrids')

@section('content')
<section class="hero-area">
    <div class="container">
        <div class="row">
            <!-- Slider الرئيسي -->
            <div class="col-lg-8 col-12 custom-padding-right">
                <div class="slider-head">
                    <div class="hero-slider">
                        <!-- شريحة 1 -->
                        <div class="single-slider" style="background-image: url('{{ asset('assets/images/hero/slider-bg1.jpg') }}');">
                            <div class="content">
                                <h2><span>No restocking fee ($35 savings)</span> M75 Sport Watch</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.</p>
                                <h3><span>Now Only</span> $320.99</h3>
                               
                            </div>
                        </div>

                        <!-- شريحة 2 -->
                        <div class="single-slider" style="background-image: url('{{ asset('assets/images/hero/slider-bg2.jpg') }}');">
                            <div class="content">
                                <h2><span>Big Sale Offer</span> Get the Best Deal on CCTV Camera</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.</p>
                                <h3><span>Combo Only:</span> $590.00</h3>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- البانرات الصغيرة -->
            <div class="col-lg-4 col-12">
                <div class="row">
                    <!-- بانر صغير 1 -->
                    <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                        <div class="hero-small-banner" style="background-image: url('{{ asset('assets/images/hero/slider-bnr.jpg') }}');">
                            <div class="content">
                                <h2><span>New line required</span> iPhone 16 Pro Max</h2>
                                <h3>$759.99</h3>
                            </div>
                        </div>
                    </div>

                    <!-- بانر صغير 2 -->
                    <div class="col-lg-12 col-md-6 col-12">
                        <div class="hero-small-banner style2">
                            <div class="content">
                                <h2>Weekly Sale!</h2>
                                <p>Saving up to 50% off all online store items this week.</p>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>


    <section class="featured-categories section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Featured Categories</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">TV &amp; Audios</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                       <div class="images">
                            <img src="{{ asset('assets/images/featured-categories/fetured-item-1.png') }}" alt="#">
                        </div>

                    </div>
                    <!-- End Single Category -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">Desktop &amp; Laptop</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="assets/images/featured-categories/fetured-item-2.png" alt="#">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">Cctv Camera</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="assets/images/featured-categories/fetured-item-3.png" alt="#">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">Dslr Camera</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="assets/images/featured-categories/fetured-item-4.png" alt="#">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">Smart Phones</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="assets/images/featured-categories/fetured-item-5.png" alt="#">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Category -->
                    <div class="single-category">
                        <h3 class="heading">Game Console</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="assets/images/featured-categories/fetured-item-6.png" alt="#">
                        </div>
                    </div>
                    <!-- End Single Category -->
                </div>
            </div>
        </div>
    </section>


    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>

   <section class="blog-section section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Our Latest News</h2>
                    <p>There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog -->
                <div class="single-blog">
                    <div class="blog-img">
                        <a href="blog-single-sidebar.html">
                            <img src="{{ asset('assets/images/blog/blog-1.jpg') }}" alt="#">
                        </a>
                    </div>
                    <div class="blog-content">
                        <a class="category" href="javascript:void(0)">eCommerce</a>
                        <h4>
                            <a href="blog-single-sidebar.html">What information is needed for shipping?</a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt.</p>
                        <div class="button">
                            <a href="javascript:void(0)" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog -->
                <div class="single-blog">
                    <div class="blog-img">
                        <a href="blog-single-sidebar.html">
                            <img src="{{ asset('assets/images/blog/blog-2.jpg') }}" alt="#">
                        </a>
                    </div>
                    <div class="blog-content">
                        <a class="category" href="javascript:void(0)">Gaming</a>
                        <h4>
                            <a href="blog-single-sidebar.html">Interesting fact about gaming consoles</a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt.</p>
                        <div class="button">
                            <a href="javascript:void(0)" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog -->
                <div class="single-blog">
                    <div class="blog-img">
                        <a href="blog-single-sidebar.html">
                            <img src="{{ asset('assets/images/blog/blog-3.jpg') }}" alt="#">
                        </a>
                    </div>
                    <div class="blog-content">
                        <a class="category" href="javascript:void(0)">Electronic</a>
                        <h4>
                            <a href="blog-single-sidebar.html">Electronics, instrumentation &amp; control engineering
                            </a>
                        </h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt.</p>
                        <div class="button">
                            <a href="javascript:void(0)" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
        </div>
    </div>
</section>

    @endsection
