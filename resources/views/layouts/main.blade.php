<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title', 'ShopGrids ')</title>
    <meta name="description" content="@yield('description', '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- استدعاء مكتبة Tiny Slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tns({
                container: '.hero-slider',
                items: 1,
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                controls: true,
                nav: false,
                speed: 500,
                loop: true,
            });
        });


    </script>



    {{-- لتضمين CSS إضافي في صفحات أخرى --}}
</head>

<body>
    
    {{-- =============== Header =============== --}}
    @include('core.partials.header')

    

    {{-- =============== Main Content =============== --}}
   
        @yield('content')


 

    {{-- =============== Footer =============== --}}
    @include('core.partials.footer')


       <a href="#" class="scroll-top" style="display: none;">
        <i class="lni lni-chevron-up"></i>
    </a>
    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<!-- Tiny Slider JS -->

    @stack('scripts') {{-- لتضمين سكريبتات إضافية --}}
</body>
</html>
