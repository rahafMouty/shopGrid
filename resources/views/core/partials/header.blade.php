<div class="preloader" style="opacity: 0; display: none;">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
<header class="header navbar-area">
        <!-- Start Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-left">
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-middle">
                            <ul class="useful-links">
                                <li><a href="{{route('index')}}">Home</a></li>
                                <li><a href="">About Us</a></li>
                                <li><a href="">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                  <div class="col-lg-4 col-md-4 col-12">
                        <div class="top-end">

                            <div class="user">
                                <i class="lni lni-user"></i>
                                {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                            </div>

                            <ul class="user-login">
                                @auth
                                    {{-- إذا المستخدم مسجّل دخول --}}
                                 <li>
                                    @if(auth()->check())
                                        @if(auth()->user()->type === 'admin')
                                            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                        @elseif(auth()->user()->type === 'customer')
                                            <a href="{{ route('customer.dashboard') }}">My Dashboard</a>
                                        @endif
                                    @endif
                                </li>


                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" style="border:none;background:none;color:#f8f9fa;cursor:pointer;">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @endauth

                                @guest
                                    {{-- إذا المستخدم غير مسجّل --}}
                                    <li>
                                        <a href="{{ route('login.form') }}">Sign In</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('register.form') }}">Register</a>
                                    </li>
                                @endguest
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Start Header Middle -->
        <div class="header-middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-7">
                        <!-- Start Header Logo -->
                        <a class="navbar-brand" href="index.html">
                            <img src="{{asset('assets/images/logo/logo.svg')}}" alt="Logo">
                        </a>
                        <!-- End Header Logo -->
                    </div>
                    <div class="col-lg-5 col-md-7 d-xs-none">
                        <!-- Start Main Menu Search -->
                        <div class="main-menu-search">
                            <!-- navbar search start -->
                            <div class="navbar-search search-style-5">
                               
                                <div class="search-input">
                                    <input type="text" placeholder="Search">
                                </div>
                                <div class="search-btn">
                                    <button><i class="lni lni-search-alt"></i></button>
                                </div>
                            </div>
                            <!-- navbar search Ends -->
                        </div>
                        <!-- End Main Menu Search -->
                    </div>
                    <div class="col-lg-4 col-md-2 col-5">
                        <div class="middle-right-area">
                            <div class="nav-hotline">
                                <i class="lni lni-phone"></i>
                                <h3>CONTACT US:
                                    <span>(+963) 938-692-084</span>
                                </h3>
                            </div>
                            @auth
                            <div class="navbar-cart">
                               
                                <div class="cart-items">
                                    <a href="javascript:void(0)" class="main-btn">
                                        <i class="lni lni-cart"></i>
                                        <span class="total-items">2</span>
                                    </a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>2 Items</span>
                                            <a href="cart.html">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            <li>
                                                <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                                                <div class="cart-img-head">
                                                    <a class="cart-img" href="product-details.html"><img src="assets/images/header/cart-items/item1.jpg" alt="#"></a>
                                                </div>

                                                <div class="content">
                                                    <h4><a href="product-details.html">
                                                            Apple Watch Series 6</a></h4>
                                                    <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                                                <div class="cart-img-head">
                                                    <a class="cart-img" href="product-details.html"><img src="assets/images/header/cart-items/item2.jpg" alt="#"></a>
                                                </div>
                                                <div class="content">
                                                    <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
                                                    <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">$134.00</span>
                                            </div>
                                            <div class="button">
                                                <a href="checkout.html" class="btn animate">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Shopping Item -->
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Middle -->
        <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                    
                        <!-- End Mega Category Menu -->
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="{{route('index')}}" aria-label="Toggle navigation">Home</a>
                                    </li>
                               
                                 @auth
                                    <li class="nav-item">
                                        <a class="dd-menu active collapsed" href="javascript:void(0)"
                                        data-bs-toggle="collapse" data-bs-target="#submenu-1-3"
                                        aria-controls="navbarSupportedContent" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                            Shop
                                        </a>

                                        <ul class="sub-menu collapse" id="submenu-1-3">
                                            <li class="nav-item active">
                                                <a href="{{ route('customer.shop') }}">Shop Grid</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endauth

                            

                                   
                                   
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
              
            </div>
        </div>
        <!-- End Header Bottom -->
    </header>