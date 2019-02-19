<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 13-Dec-16
 * Time: 12:59
 */
?>
@extends('user.master')
@section('title', 'Thông tin đặt hàng')
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
                        <li class="active">Thông tin đặt hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- coupon-area start -->
    @if(!Auth::guard('user')->check())
    <div class="coupon-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="coupon-accordion">
                        <!-- ACCORDION START -->
                        <h3>Đăng nhập để nhận nhiều ưu đãi hơn? <span id="showlogin">Click để đăng nhâp</span></h3>
                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text"></p>
                                <form action="{{ url('/login') }}" method="post" id="form-input">
                                    {{ csrf_field() }}
                                    @include('errors.flash-error')
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <p class="form-row-first">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input id="email" name="email" type="email" placeholder="Nhập địa chỉ email" required value="{{ old('email') }}" autofocus/>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <p class="form-row-first">
                                            <label for="password">Mật khẩu <span class="required">*</span></label>
                                            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu của bạn" required/>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </p>
                                    </div>

                                    <p class="form-row">
                                        <input class="btn" type="submit" value="Đăng nhập" />
                                    </p>
                                    <p class="lost-password">
                                        <a href="{{ url('/password/reset') }}">Bạn quên mật khẩu?</a>
                                            <a href="{{ url('/register') }}">Đăng ký tài khoản mới</a></p>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <!-- ACCORDION END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- coupon-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area">
        <div class="container">
            <div class="row">
                <form action="" method="post" id="form-input">
                    {{ csrf_field() }}
                    <div class="col-lg-6 col-md-6">
                        <div class="checkbox-form">
                            <h3>Thông tin đơn hàng</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email của bạn <span class="required">*</span></label>
                                        <input type="email" placeholder="Nhập email" required name="txtEmail" value="@if(Auth::guard('user')->check()) {!! Auth::guard('user')->user()->email !!}@endif"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Họ tên người nhận <span class="required">*</span></label>
                                        <input type="text" placeholder="Nhập họ tên" required name="txtName" value="@if(Auth::guard('user')->check()) {!! Auth::guard('user')->user()->name !!}@endif"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Số điện thoại người nhận <span class="required">*</span></label>
                                        <input type="text" placeholder="Nhập số điện thoại" required name="txtPhone"  value="@if(Auth::guard('user')->check()) {!! Auth::guard('user')->user()->phone !!}@endif" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Địa chỉ người nhận</label>
                                        <input type="text" placeholder="Nhập địa chỉ" required name="txtAddress"  value="@if(Auth::guard('user')->check()) {!! Auth::guard('user')->user()->address !!}@endif"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="country-select">
                                        <label>Phương thức thanh toán</label>
                                        <select name="txtPayment" id="txtPayment">
                                            @foreach($data_payment as $item)
                                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="country-select">
                                        <label>Phương thức giao hàng</label>
                                        <select name="txtDelivery" id="txtDelivery">
                                            @foreach($data_delivery as $item)
                                                <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="order-notes">
                                        <div class="checkout-form-list">
                                        <label>Ghi chú </label>
                                        <textarea name="txtNote" id="checkout-mess" cols="30" rows="10" placeholder="Nhập chú thích" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="your-order">
                            <h3>Tóm tắt đơn hàng</h3>
                            <div class="your-order-table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product-name">Sản Phẩm</th>
                                        <th class="product-total">Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($content as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                           {!! $item->name !!} - size: {!! $item->options['size'] !!} @if(isset($item->options['color'])&& $item->options['color'] != '') - màu: {!! $item->options['color'] !!} @endif <strong class="product-quantity"> × {!! $item->qty !!}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">{!! number_format($item->price*$item->qty, 0, ",", ".") !!}<sup>đ</sup></span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="order-total">
                                        <th>Tổng cộng</th>
                                        <td><strong><span class="amount">{!! $total !!}<sup>đ</sup></span></strong>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">

                                <div class="order-button-payment">
                                    <input class="btn" type="submit" value="Đặt hàng" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
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
            $('#form-input .btn[type="submit"]').on('click', function() {
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
@endsection