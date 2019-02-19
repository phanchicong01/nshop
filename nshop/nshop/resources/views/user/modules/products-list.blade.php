<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 12-Dec-16
 * Time: 15:56
 */
?>
@extends('user.master')
@section('title', $cate_name->name)
@section('keywords', '')
@section('description', '')
@section('content-main')
    <?php
        if(isset($_GET['price_from']))
            $price_from = $_GET['price_from'];
        else
            $price_from = '';
        if(isset($_GET['price_to']))
            $price_to = $_GET['price_to'];
        else
            $price_to = '';
        if(isset($_GET['sort']))
            $sort = $_GET['sort'];
        else
            $sort = 1;
        ?>
    <div id="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{!! route('index') !!}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                        </li>
                        @if($cate_name_parent != '')
                        <li>
                            <a href="{!! route('getCategory', ['id' => $cate_name_parent->id, 'slug' => $cate_name_parent->alias]) !!}"> {!! $cate_name_parent->name !!}</a>
                        </li>
                        @endif
                        <li class="active">{!! $cate_name->name !!}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- shop-area start -->
    <div class="shop-area">
        <div class="container">
            <div class="row">
                <!-- left-sidebar start -->
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <!-- widget-categories start -->
                    <aside class="widget widget-categories">
                        <h3 class="sidebar-title">Các Loại Tương Tự</h3>
                        <ul class="sidebar-menu">
                            @foreach($data_cate as $item)
                                <li><a href="{!! route('getCategory', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></li>
                            @endforeach
                        </ul>
                    </aside>
                    <!-- widget-categories end -->
                    <!-- shop-filter start -->
                    <aside class="widget shop-filter">
                        <h3 class="sidebar-title">Tìm kiếm theo giá</h3>
                        <div class="info_widget">
                            <div class="price_filter">
                                <form action="" method="get">
                                    <div id="slider-range">
                                        <input type="text" name="price_from" value="{!! $price_from !!}" placeholder="Giá từ" />
                                        <input type="text" name="price_to" value="{!! $price_to !!}" placeholder="Giá đến" />
                                    </div>
                                    <div class="price_slider_amount center-block">
                                        <input type="submit"  value="Lọc"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </aside>
                    <!-- shop-filter end -->
                    <!-- widget-recent start -->
                    <aside class="widget top-product-widget hidden-sm">
                        <h3 class="sidebar-title">Sản phẩm hot</h3>
                        <div class="banner-curosel">
                            @foreach($data_hot as $item)
                            <div class="banner">
                                <?php
                                $image_data = getImageProduct($item["id"]);
                                ?>
                                <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                    @if($image_data != '')
                                        <img src="{!! $image_data->image!= '' ? asset('public/images/uploads/products/'.$image_data->image) : asset('public/images/icons/no-photo.png') !!}" class="img-responsive">
                                    @else
                                        <img src="{!! asset('public/images/icons/no-photo.png') !!}"  class="img-responsive">
                                    @endif
                                </a>
                                <div class="upcoming-pro text-center">
                                    <div ><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </aside>
                    <!-- widget-recent end -->
                </div>
                <!-- left-sidebar end -->
                <!-- shop-content start -->
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="shop-content">
                        <!-- Nav tabs -->
                        <ul class="shop-tab" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th"></i></a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list"></i></a></li>
                        </ul>
                        <div class="show-result">
                            <p> Hiển thị {!! $data->firstItem() !!} đến {!! $data->lastItem() !!} của {!! $data->total() !!} sản phẩm</p>
                        </div>
                        <div class="toolbar-form">
                            <form action="" method="get">
                                @if($price_from != '' || $price_to != '')
                                <input type="hidden" name="price_from" value="{!! $price_from !!}" placeholder="Giá từ" />
                                <input type="hidden" name="price_to" value="{!! $price_to !!}" placeholder="Giá đến" />

                                @endif
                                <div class="tolbar-select">
                                    <select name="sort" onchange="this.form.submit()">
                                        <option value="1" @if($sort == 1) selected @endif>Sắp xếp theo sản phẩm mới nhất</option>
                                        <option value="2" @if($sort == 2) selected @endif>Sắp xếp theo sản phẩm xem nhiều nhất</option>
                                        <option value="3" @if($sort == 3) selected @endif>Sắp xếp theo sản phẩm bán nhiều nhất</option>
                                        <option value="4" @if($sort == 4) selected @endif>Sắp xếp theo giá cao đến thấp</option>
                                        <option value="5" @if($sort == 5) selected @endif>Sắp xếp theo giá thấp đến cao</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="row">
                                    @foreach($data as $item)
                                    <!-- single-product start -->
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                                    <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                                    @foreach($data_images as $item_images)
                                                        @if($i == 0)
                                                            <img class="primary-image" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}" />
                                                            <?php $i++;?>
                                                        @else
                                                            <img class="secondary-image" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}-1" />
                                                        @endif
                                                    @endforeach
                                                </a>
                                                @if($item['promotion'] != '')
                                                    <span class="sale">sale</span>
                                                @endif
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                                        <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                                                <div class="pro-price text-center">
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
                                    </div>
                                    <!-- single-product end -->
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <div class="row shop-list">
                                @foreach($data as $item)
                                    <!-- single-product start -->
                                    <div class="col-md-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                                    <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                                    @foreach($data_images as $item_images)
                                                        @if($i == 0)
                                                            <img class="primary-image" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}" />
                                                            <?php $i++;?>
                                                        @else
                                                            <img class="secondary-image" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}-1" />
                                                        @endif
                                                    @endforeach
                                                </a>
                                                @if($item['promotion'] != '')
                                                    <span class="sale">sale</span>
                                                @endif
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
                                                <div class="product-desc">
                                                    <p>{!! strip_tags(cutString($item['content'], 300)) !!}</p>
                                                </div>
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                                        <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product end -->
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-pagination">
                        @if($price_to != '' || $price_from != '')
                            @if($sort != 1)
                                {!! $data->appends(['price_from' => $price_from, 'price_to' => $price_to, 'sort' => $sort])->links() !!}
                            @else
                                {!! $data->appends(['price_from' => $price_from, 'price_to' => $price_to])->links() !!}
                            @endif
                        @else
                            @if($sort != 1)
                                {!! $data->appends(['sort' => $sort])->links() !!}
                            @else
                                {!! $data->links() !!}
                            @endif
                        @endif

                    </div>
                </div>
                <!-- shop-content end -->
            </div>
        </div>
    </div>
    <!-- shop-area end -->
@endsection
