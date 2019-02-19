<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 17:29
 */
?>
@extends('user.master')
@section('title', 'Trang chủ')
@section('keywords', '')
@section('description', '')
@section('content-main')
<!-- HOME SLIDER -->
@include("user.blocks.slider")
<!-- END HOME SLIDER -->
<!-- banner-area start -->
{{--@include("user.blocks.banner")--}}
<!-- banner-area end -->
<!-- features-area start -->
@include("user.blocks.features")
<!-- features-area end -->
<!-- new-product-area start -->
@include("user.blocks.new-product")
<!-- new-product-area end -->
<!-- subscribe-area start -->
@include("user.blocks.subscribe")
<!-- subscribe-area end -->
<!-- category-area start -->
@include("user.blocks.category")
<!-- category-area end -->
@endsection
@section('content-sub')
    <!-- latest-blog-area start -->
    @include("user.blocks.news-blog")
    <!-- latest-blog-area end -->
    <!-- brand-area start -->
    {{--@include("user.blocks.brand")--}}
    <!-- brand-area end -->
@endsection
@section('javascript')
    @if ($errors->has('txtEmail'))
        <script type="text/javascript">
            $(document).ready(function () {
                sweetAlert("Oops...", "{!! $errors->first('txtEmail') !!}", "error");
            });
        </script>
    @endif
@endsection