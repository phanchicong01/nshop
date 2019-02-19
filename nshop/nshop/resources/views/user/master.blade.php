<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 15:58
 */
?>

<!doctype html>
<html class="no-js" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keyword" content="@yield('keywords')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link href="{!! asset('public/images/icons/favicon.ico') !!}" rel="shortcut icon" >
    <!-- all css here -->
    <!-- Bootstrap -->
    <link href="{!! asset("public/vendors/bootstrap/dist/css/bootstrap.min.css") !!}" rel="stylesheet">
    <!-- animate css -->
    <link rel="stylesheet" href="{!! asset("public/css/animate.css") !!}">
    <!-- jquery-ui.min css -->
    <link rel="stylesheet" href="{!! asset("public/css/jquery-ui.min.css") !!}">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="{!! asset("public/css/meanmenu.min.css") !!}">
    <!-- RS slider css -->
    <link rel="stylesheet" type="text/css" href="{!! asset("public/lib/rs-plugin/css/settings.css") !!}" media="screen" />
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{!! asset("public/css/owl.carousel.css") !!}">
    <!-- Font Awesome -->
    <link href="{!! asset("public/vendors/font-awesome/css/font-awesome.min.css") !!}" rel="stylesheet">
    <!-- style css -->
    <link rel="stylesheet" href="{!! asset("public/css/style.css") !!}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{!! asset("public/css/responsive.css") !!}">
    <!-- modernizr css -->
    <script src="{!! asset("public/js/vendor/modernizr-2.8.3.min.js") !!}"></script>
    <!-- SweetAlert -->
    <link href="{!! asset('public/vendors/sweetalert2/sweetalert2.min.css') !!}" rel="stylesheet" >
    @yield('css')
</head>
<body>
<!-- Add your site or application content here -->

<header>
    <!-- header-top-area start -->
    @include("user.blocks.header-top")
    <!-- header-top-area end -->
    <!-- header-bottom-area start -->
    @include("user.blocks.header-bottom")
    <!-- header-bottom-area end -->
    <!-- main-menu-area start -->
    @include("user.blocks.main-menu")
    <!-- main-menu-area end -->
    <!-- mobile-menu-area start -->
    @include("user.blocks.mobile-menu")
<!-- mobile-menu-area end -->
</header>
@yield('content-main')
<!-- service-area start -->
@include("user.blocks.service")
<!-- service-area end -->
@yield('content-sub')
<!-- footer start -->
<footer>
    <!-- footer-top-area start -->
    @include("user.blocks.footer-top")
    <!-- footer-top-area end -->
    <!-- footer-bottom-area start -->
    @include("user.blocks.footer-bottom")
    <!-- footer-bottom-area end -->
</footer>
<!-- footer end -->

<!-- all js here -->
<!-- jquery latest version -->
<script src="{!! asset("public/js/vendor/jquery-1.12.0.min.js") !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset("public/vendors/bootstrap/dist/js/bootstrap.min.js") !!}"></script>
<!-- owl.carousel js -->
<script src="{!! asset("public/js/owl.carousel.min.js") !!}"></script>
<!-- jquery-ui js -->
<script src="{!! asset("public/js/jquery-ui.min.js") !!}"></script>
<!-- RS-Plugin JS -->
<script type="text/javascript" src="{!! asset("public/lib/rs-plugin/js/jquery.themepunch.tools.min.js") !!}"></script>
<script type="text/javascript" src="{!! asset("public/lib/rs-plugin/js/jquery.themepunch.revolution.min.js") !!}"></script>
<script src="{!! asset("public/lib/rs-plugin/rs.home.js") !!}"></script>
<!-- meanmenu js -->
<script src="{!! asset("public/js/jquery.meanmenu.js") !!}"></script>
<!-- wow js -->
<script src="{!! asset("public/js/wow.min.js") !!}"></script>
<!-- plugins js -->
<script src="{!! asset("public/js/plugins.js") !!}"></script>
<!-- main js -->
<script src="{!! asset("public/js/main.js") !!}"></script>
<!-- Sweet alert-->
<script src="{!! asset('public/vendors/sweetalert2/sweetalert2.min.js') !!}"></script>
@if (Session::has('flash_level') && Session::get('flash_level') == 'result_msg')
    <script>
        $(document).ready(function () {
            swal("Thành Công!", "{!! Session::get('flash_messages') !!}", "success");
        });
    </script>
@endif

@yield('javascript')
</body>
</html>
