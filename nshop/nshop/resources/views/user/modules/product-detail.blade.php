<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 12-Dec-16
 * Time: 22:09
 */
?>
@extends('user.master')
@section('title', $data['name'])
@section('keywords', $data['keyword'])
@section('description', $data['description'])
@section('content-main')
    <div id="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{!! route('index') !!}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                        </li>
                        <li>
                            <a href="{!! route('getCategory', ['id' => $data['cate']['id'], 'slug' => $data['cate']['alias']]) !!}">{!! $data['cate']['name'] !!}</a>
                        </li>
                        <li class="active">{!! $data['name'] !!}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- single-product-area start -->
    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="single-pro-tab-content">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?php $flag = 0;?>
                                    @foreach($image_data as $item)
                                        <?php $flag++;?>
                                        <div role="tabpanel" class="tab-pane @if($flag == 1) active @endif" id="image-{!! $flag !!}"><a href="#"><img src="{!! asset('public/images/uploads/products/'.$item['image']) !!}" alt="{!! $data['name'].'-'.$flag !!}" /></a></div>
                                    @endforeach
                                </div>
                                <!-- Nav tabs -->
                                <ul class="single-product-tab" role="tablist">
                                    <?php $flag = 0;?>
                                    @foreach($image_data as $item)
                                        <?php $flag++;?>
                                    <li role="presentation" @if($flag == 1) class="active" @endif><a href="#image-{!! $flag !!}" aria-controls="home" role="tab" data-toggle="tab"><img src="{!! asset('public/images/uploads/products/'.$item['image']) !!}" alt="{!! $data['name'].'-'.$flag !!}" /></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12 shop-list">
                            <div class="product-info">
                                <h3><a href="#">{!! $data['name'] !!}</a></h3>
                                <div class="pro-price">
                                    <span class="normal">
                                    @if($data['promotion'] != '')
                                        {!! number_format($data['promotion'], 0, ',', '.') !!}<sup>đ</sup>
                                    @else
                                        {!! number_format($data['price'], 0, ',', '.') !!}<sup>đ</sup>
                                        @endif
                                    </span>
                                </div>
                                <div class="product-action">
                                    <form action="{!! route('addCart', ['id' => $data["id"]]) !!}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{!! $data['id'] !!}">
                                        @if($size_data != NULL)
                                        <p>
                                            <label for="txtSize">Size: </label>
                                            <select id="txtSize" name="size">
                                                @foreach($size_data as $item)
                                                    <option value="{!! $item['size'] !!}">{!! $item['size'] !!}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        @endif

                                        @if($color_data != NULL)
                                        <p>
                                            <label for="txtColor">Color: </label>
                                            <select id="txtColor" name="color">
                                                @foreach($color_data as $item)
                                                    <option value="{!! $item['color'] !!}">{!! $item['color'] !!}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                            @endif
                                        <div class="cart-plus-minus">
                                            <p>
                                                <label for="txtQuantity">Số lượng: </label>
                                                <input id="txtQuantity" name="quantity" type="text" value="1"/>
                                            </p>
                                        </div>
                                        <button type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mua ngay</button>
                                    </form>

                                </div>
                                <div class="widget-icon"> <b>Chia sẻ:
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="product-tabs">
                                <div>
                                    <!-- Nav tabs -->
                                    <ul class="pro-details-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab-desc" aria-controls="tab-desc" role="tab" data-toggle="tab">Mô tả sản phẩm</a></li>
                                        <li role="presentation"><a href="#page-comments" aria-controls="page-comments" role="tab" data-toggle="tab">Bình luận ({!! $comment_count !!})</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="tab-desc">
                                            <div class="product-tab-desc">
                                                {!! $data['content'] !!}
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="page-comments">
                                            <div class="product-tab-desc">
                                                <div class="product-page-comments">
                                                    <ul>
                                                        @foreach($data_comment as $item)
                                                        <li>
                                                            <div class="product-comments">
                                                                <img src="@if($item["user"]["avatar"] != '') {!! asset('public/images/uploads/users/'.$item["user"]['avatar']) !!} @else {!! asset('public/images/icons/avatar2.png') !!} @endif" alt="" width="80" height="80"/>
                                                                <div class="product-comments-content">
                                                                    <p><strong>{!! $item["user"]["name"] !!}</strong> -
                                                                        <span>
                                                                            <?php \Carbon\Carbon::setLocale('vi') ?>
                                                                            {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}
                                                                        </span>
                                                                    </p>
                                                                    <div class="desc">{!! $item['content'] !!}</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="review-form-wrapper">
                                                        <h3>Bình luận về sản phẩm này</h3>
                                                        @if(\Illuminate\Support\Facades\Auth::guard('user')->check())
                                                        <form action="" method="post" class="form-horizontal" id="form-input">
                                                            {!! csrf_field() !!}
                                                            <div class="@if ($errors->has('txtName')) has-error @endif">
                                                            <input type="text" name="txtName" placeholder="Tên của bạn (bắt buộc)" required readonly class="form-control" value="{!! \Illuminate\Support\Facades\Auth::guard('user')->user()->name !!}"/>
                                                                @if ($errors->has('txtName'))
                                                                    <span class="help-block">{{ $errors->first('txtName') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="@if ($errors->has('txtEmail')) has-error @endif">
                                                            <input type="email" name="txtEmail" placeholder="Địa chỉ email của bạn" readonly class="form-control" value="{!! \Illuminate\Support\Facades\Auth::guard('user')->user()->email !!}"/>
                                                                @if ($errors->has('txtEmail'))
                                                                    <span class="help-block">{{ $errors->first('txtEmail') }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="@if ($errors->has('txtContent')) has-error @endif">
                                                            <textarea id="product-message" name="txtContent" cols="30" rows="10" required placeholder="Nội dung (bắt buộc)" class="form-control">{!! old('txtContent') !!}</textarea>
                                                                @if ($errors->has('txtContent'))
                                                                    <span class="help-block">{{ $errors->first('txtContent') }}</span>
                                                                @endif
                                                            </div>
                                                            {{--<div class="@if ($errors->has('g-recaptcha-response')) has-error @endif" >--}}
                                                            {{--{!! Recaptcha::render() !!}--}}
                                                                {{--@if ($errors->has('g-recaptcha-response'))--}}
                                                                    {{--<span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>--}}
                                                                {{--@endif--}}
                                                            {{--</div>--}}
                                                            <br>
                                                            <input class="btn" type="submit" value="Đăng bình luận" />
                                                        </form>
                                                        @else
                                                            <p class="text-danger" style="font-size: 16px;">Bạn cần đăng nhập để bình luận
                                                                <a href="{!! url('login') !!}" class="text-primary"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Click để đăng nhập</a></p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="section-title text-center">
                                <h2>Sản phẩm tương tự</h2>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="related-curosel">
                            @foreach($data_cate as $item)
                            <!-- single-product start -->
                            <div class="col-lg-12">
                                <div class="single-product">
                                    <div class="product-img related-product-image">
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
                                        @if($item['promotion'] != '')
                                            <span class="sale">sale</span>
                                        @endif
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                            </div>
                                        </div>
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
                            </div>
                            <!-- single-product end -->
                          @endforeach
                        </div>
                    </div>
                </div>
                <!-- right-sidebar start -->
                <div class="col-lg-3 col-md-3">
                    <div id="intro-area">
                        <h3>Shop thời trang</h3>
                        <div class="intro-border">
                            <a href="{!! route('getHDMH') !!}" target="_blank">Hướng dẫn mua hàng</a>
                            <ul class="info-service">
                                <li><span>1</span> Giao hàng TOÀN QUỐC</li>
                                <li><span>2</span> Thanh toán khi nhận hàng</li>
                                <li><span>3</span> Đổi trả trong 15 ngày</li>
                                <li><span>4</span> Chất lượng đảm bảo</li>
                                <li><span>5</span> Hàng luôn sẵn có </li>
                                <li><span>6</span> MIỄN PHÍ vận chuyển:</li>
                                <li style="padding-left:30px;">» Đơn hàng trên 1 triệu đồng</li>
                            </ul>
                        </div>
                    </div>
                    <div class="margin-top-20"></div>
                    <!-- recent start -->
                    <aside class="widget widget-categories margin-top-20">
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
                <!-- right-sidebar end -->
            </div>
        </div>
    </div>
    <!-- single-product-area end -->
@endsection
@section('javascript')
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
    <!-- Parsley -->
    <script>
        $(document).ready(function() {
            $.listen('parsley:field:validate', function() {
                validateFront();
            });
            $('#form-input .btn').on('click', function() {
                $('#form-input').parsley().validate();
                validateFront();
            });
            var validateFront = function() {
                if (true === $('#form-input').parsley().isValid()) {
                    $('.bs-callout-info').removeClass('hidden');
                    $('.bs-callout-warning').addClass('hidden');
                } else {
                    $('.bs-callout-info').addClass('hidden');
                    $('.bs-callout-warning').removeClass('hidden');
                }
            };
        });
        try {
            hljs.initHighlightingOnLoad();
        } catch (err) {}
    </script>
    <!-- /Parsley -->
    @if (Session::has('flash_level') && Session::get('flash_level') == 'result_msg')
        <script>
            $(document).ready(function () {
                swal("Thành Công!", "{!! Session::get('flash_messages') !!}", "success");
            });
        </script>
    @endif
@endsection