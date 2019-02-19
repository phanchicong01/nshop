<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 07-Dec-16
 * Time: 13:11
 */
?>
@extends('admin.master')
@section('title', 'Dashboard | Admin')
@section('keywords', '')
@section('description', '')
@section('content')
<div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-cube"></i></div>
            <div class="count">{!! $count_product !!}</div>
            <h3>Sản Phẩm</h3>
            <p><a href="#">Xem tất cả</a></p>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i></div>
            <div class="count">{!! $count_comment !!}</div>
            <h3>Bình Luận</h3>
            <p><a href="#">Xem tất cả</a></p>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-shopping-bag"></i></div>
            <div class="count">{!! $count_order !!}</div>
            <h3>Đơn Hàng</h3>
            <p><a href="#">Xem tất cả</a></p>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-users"></i></div>
            <div class="count">{!! $count_user !!}</div>
            <h3>Khách Hàng</h3>
            <p><a href="#">Xem tất cả</a></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sản Phẩm Bán Chạy Nhất</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach($data_product_sell as $item)
                <article class="media event">
                    <div class="media-body">
                        <i class="fa fa-caret-square-o-right" aria-hidden="true"></i> <a class="title" href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}" target="_blank">{!! $item['name'] !!}</a>
                        <p>Giá: {!! number_format($item["price"]) !!} <sup>đ</sup> - Số lần bán: {!! $item['count_sell'] !!}</p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Khách Hàng Mới Nhất</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach($data_customer as $item)
                    <article class="media event">
                        <div class="media-body">
                            <i class="fa fa-caret-square-o-right" aria-hidden="true"></i> <a class="title" href="#" target="_blank">{!! $item['name'] !!}</a>
                            <p>Email: {!! $item['email'] !!} - Ngày đăng ký: {!! date('d-m-Y', strtotime($item['created_at'])) !!}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Bình Luận Mới Nhất</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach($data_comment as $item)
                    <article class="media event">
                        <div class="media-body">
                            <i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Nội dung: {!! $item['content'] !!}
                            <p>Bởi: {!! $item['user']['name'] !!}- Lúc:
                                <?php \Carbon\Carbon::setLocale('vi') ?>
                                {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}
                                - <a class="title" href="{!! route('getProduct', ['id' => $item['product']['id'], 'slug' => $item['product']['alias']]) !!}" target="_blank">{!! $item['product']['name'] !!}</a>
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection