<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 16-Dec-16
 * Time: 02:27
 */
?>

@extends('user.master')
@section('title', 'Trang cá nhân')
@section('keywords', '')
@section('description', '')
@section('content-main')
    <div id="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{!! route('index') !!}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                        </li>
                        <li class="active">Thông tin tài khoản</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- my-account-area start -->
    <div class="my-account-area">
        <div class="container">
            <div class="row">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="col-md-2 col-md-offset-1">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar" style="width: 300px;">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="@if($data["avatar"] != '') {!! asset('public/images/uploads/users/'.$data['avatar']) !!} @else {!! asset('public/images/icons/avatar2.png') !!} @endif" class="img-responsive" width="100%" alt="">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name text-center" style="font-weight: bold; font-size: 20px; color: #1F568B; margin-top: 10px">
                                    {!! $data['name'] !!}
                                </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li class="active"><a href="#"> <i class="fa fa-home" aria-hidden="true"></i> Tổng quan </a></li>
                                    <li><a href="{!! route('getCustomerProfileEdit', ['id' => \Illuminate\Support\Facades\Auth::guard('user')->user()->id]) !!}"> <i class="fa fa-cog" aria-hidden="true"></i> Cài đặt tài khoản </a></li>
                                    <li><a href="#action"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> {!! $order_count !!} đơn hàng <i class="fa fa-comment" aria-hidden="true"></i> {!! $comment_count !!} bình luận </a></li>
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                </div>
                <!-- END PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="col-md-7 pull-right">

                    <!-- Hiển thị thông tin cá nhân -->
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class=""><b>THÔNG TIN TÀI KHOẢN</b></span>
                            </div>

                        </div>
                        <div class="portlet-body">

                            <p style="font-size: 16px;">Họ Tên: {!!  $data['name']!!}</p>
                            <p style="font-size: 16px;">Số Điện Thoại: {!!  $data['phone']!!}</p>
                            <p style="font-size: 16px;">Địa Chỉ:  {!!  $data['address']!!}</p>
                            <p style="font-size: 16px;">Giới tính: @if($data['gender'] == 1) Nam @else Nữ @endif </p>
                            <p style="font-size: 16px;">Ngày sinh: {!!  date('d-m-Y', strtotime($data['birthday']))!!}</p>
                            <!-- END PERSONAL INFO TAB -->
                        </div>
                    </div>
                    <!-- end Hiển thị thông tin cá nhân -->
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light" id="action">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class=""><b>HOẠT ĐỘNG</b></span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_1" data-toggle="tab">Đơn hàng đã đặt</a>
                                </li>
                                <li>
                                    <a href="#tab_1_2" data-toggle="tab">Bình luận </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                        <ul class="feeds">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        @foreach($order_data as $item)
                                                        <div class="row order-list">
                                                            <div class="col-md-1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-shopping-bag"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <div class="desc">
                                                                    <a href="{!! route('OrderDetail', ["id" => $item["id"]]) !!}">
                                                                        <span style="margin-left: 10px; font-size: 16px;"> Đơn Hàng: {!! $item['code_order'] !!} - Ngày đặt: {!! date('d-m-Y', strtotime($item['created_at'])) !!} </span><br>
                                                                        <span style="margin-left: 10px;">
                                                                            <?php $data_detail =  getOrderDetail($item['id'])?>
                                                                            Chi tiết: {!! $data_detail['count_item'] !!} sản phẩm - tổng tiền: {!! number_format($data_detail['sum'], 0, ',', '.') !!} VNĐ - trạng thái: @if($item['status']) Đã giao @else Chưa giao @endif</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_1_2">
                                    <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                        <ul class="feeds">
                                            <li>
                                                <a href="#comment">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            @foreach($comment_data as $item)
                                                            <div class="row order-list">
                                                                <div class="col-md-1">
                                                                    <div class="label label-sm label-info">
                                                                        <i class="fa fa-comment"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <div class="desc">
                                                                        <a href="{!! route('getProduct', ['id' => $item['product']['id'], 'slug' => $item['product']['alias']]) !!}">
                                                                            <span style="margin-left: 10px; font-size: 14px;"> Nội dung: {!! $item['content'] !!}</span><br>
                                                                            <span style="margin-left: 10px;"> Sản phẩm: <a href="{!! route('getProduct', ['id' => $item['product']['id'], 'slug' => $item['product']['alias']]) !!}">{!! $item['product']['name'] !!}</a> - {!! date('d-m-Y', strtotime($item['created_at'])) !!}</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END TABS-->
                        </div>
                    </div>
                    <!-- END PORTLET -->
                </div>
                <!-- END PORTLET -->
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- my-account-area end -->
@endsection

@section('javascript')
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
    <!-- Parsley -->
    <script>
        $(document).ready(function() {
            var obj;
            $('.profile-usermenu li').mouseover(function () {
                obj = $('.profile-usermenu').find('.active');
                obj.removeClass('active');
            });
            $('.profile-usermenu li').mouseleave(function () {
                obj.addClass('active');
            })
        })
    </script>
    <!-- /Parsley -->
@endsection

