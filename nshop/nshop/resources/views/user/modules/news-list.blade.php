<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 12-Dec-16
 * Time: 23:35
 */
?>
@extends('user.master')
@section('title', 'Danh sách tin')
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
                        <li class="active">Danh sách tin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- shop-area start -->
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <!-- left-sidebar start -->
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <!-- recent start -->
                    <aside class="widget widget-categories">
                        <h3 class="sidebar-title">Sản phẩm hot</h3>
                        <div class="widget-curosel">
                        @foreach($data_hot as $item)
                            <!-- single-product start -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                            <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                            @foreach($data_images as $item_images)
                                                @if($i == 0)
                                                    <img class="primary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="" />
                                                    <?php $i++;?>
                                                @else
                                                    <img class="secondary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="" />
                                                @endif
                                            @endforeach
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h3><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                                        <div class="pro-price">
                                        <span class="normal">
                                                         @if($item['promotion'] != '')
                                                {!! number_format($item['promotion'], 0, ',', '.') !!}<sup>đ</sup>
                                            @else
                                                {!! number_format($item['price'], 0, ',', '.') !!}<sup>đ</sup>
                                            @endif
                                                        </span>
                                            @if($item['promotion'] != '')
                                                <span class="old">{!! number_format($item['price'], 0, ',', '.') !!}<sup>đ</sup></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product end -->
                            @endforeach
                        </div>
                    </aside>
                    <!-- recent end -->
                </div>
                <!-- left-sidebar end -->
                <!-- shop-content start -->
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    @foreach($data as $item)
                    <!-- single-latest-blog start -->
                    <div class="single-latest-blog">
                        <div class="latest-blog-img">
                            <a href="{!! route('getNewsDetail', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                <img alt="" src="{!! asset('public/images/uploads/news/'.$item['image']) !!}">
                            </a>
                        </div>
                        <div class="latest-blog-content">
                            <h3><a href="{!! route('getNewsDetail', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                            <div class="meta">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    <?php \Carbon\Carbon::setLocale('vi') ?>
                                    {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}
                                </span>
                            </div>
                            <p>{!! cutString($item['intro'], 300) !!}</p>
                            <a href="{!! route('getNewsDetail', ['id' => $item['id'], 'slug' => $item['alias']]) !!}" class="readmore">Chi tiết</a>
                        </div>
                    </div>
                    <!-- single-latest-blog end -->
                    @endforeach
                    <div class="shop-pagination">
                       {!! $data->render() !!}
                    </div>
                </div>
                <!-- shop-content end -->
            </div>
        </div>
    </div>
    <!-- shop-area end -->
@endsection
