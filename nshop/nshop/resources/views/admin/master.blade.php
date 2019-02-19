<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 07-Dec-16
 * Time: 13:12
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | Admin</title>
    <meta content="@yield('description')" name="description">
    <meta content="@yield('keywords')" name="keywords">
    <link href="{!! asset('public/images/icons/favicon.ico') !!}" rel="shortcut icon" >
    <!-- Bootstrap -->
    <link href="{!! asset("public/vendors/bootstrap/dist/css/bootstrap.min.css") !!}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{!! asset("public/vendors/font-awesome/css/font-awesome.min.css") !!}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{!! asset("public/vendors/nprogress/nprogress.css") !!}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{!! asset("public/vendors/bootstrap-daterangepicker/daterangepicker.css") !!}" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="{!! asset('public/vendors/sweetalert2/sweetalert2.min.css') !!}" rel="stylesheet" >
    <!-- Custom Theme Style -->
    <link href="{!! asset("public/css/custom.min.css") !!}" rel="stylesheet">
    @yield('css')
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

    {{--menu start--}}
        @include('admin.blocks.sidebar')
    {{--menu end--}}
    <!-- top navigation -->
        @include('admin.blocks.topbar')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                @yield('content')
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
            @include('admin.blocks.footer')
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{!! asset("public/vendors/jquery/dist/jquery.min.js") !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset("public/vendors/bootstrap/dist/js/bootstrap.min.js") !!}"></script>
<!-- FastClick -->
<script src="{!! asset("public/vendors/fastclick/lib/fastclick.js") !!}"></script>
<!-- NProgress -->
<script src="{!! asset("public/vendors/nprogress/nprogress.js") !!}"></script>

<!-- jQuery Sparklines -->
<script src="{!! asset("public/vendors/jquery-sparkline/dist/jquery.sparkline.min.js") !!}"></script>
<!-- Flot -->
<script src="{!! asset("public/vendors/Flot/jquery.flot.js") !!}"></script>
<script src="{!! asset("public/vendors/Flot/jquery.flot.pie.js") !!}"></script>
<script src="{!! asset("public/vendors/Flot/jquery.flot.time.js") !!}"></script>
<script src="{!! asset("public/vendors/Flot/jquery.flot.stack.js") !!}"></script>
<script src="{!! asset("public/vendors/Flot/jquery.flot.resize.js") !!}"></script>
<!-- Flot plugins -->
<script src="{!! asset("public/vendors/flot.orderbars/js/jquery.flot.orderBars.js") !!}"></script>
<script src="{!! asset("public/vendors/flot-spline/js/jquery.flot.spline.min.js") !!}"></script>
<script src="{!! asset("public/vendors/flot.curvedlines/curvedLines.js") !!}"></script>
<!-- DateJS -->
<script src="{!! asset("public/vendors/DateJS/build/date.js") !!}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{!! asset("public/vendors/moment/min/moment.min.js") !!}"></script>
<script src="{!! asset("public/vendors/bootstrap-daterangepicker/daterangepicker.js") !!}"></script>
<!-- Sweet alert-->
<script src="{!! asset('public/vendors/sweetalert2/sweetalert2.min.js') !!}"></script>
<!-- Custom Theme Scripts -->
<script src="{!! asset("public/js/custom.min.js") !!}"></script>
@yield('javascript')
</body>
</html>