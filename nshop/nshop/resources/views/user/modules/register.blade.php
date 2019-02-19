<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 18:37
 */
?>
@extends('user.master')
@section('title', 'Đăng ký')
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
                        <li class="active">Đăng ký</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- my-account-area start -->
    <div class="my-account-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-md-offset-3">
                    <form action="{{ url('/register') }}" method="post" id="form-input">
                        {{ csrf_field() }}
                        <div class="form-fields">
                            <h2>Đăng ký</h2>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <p>
                                <label for="email">Email <span class="required">*</span></label>
                                <input id="email" name="email" type="email" placeholder="Nhập địa chỉ email" required  value="{{ old('email') }}"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </p>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <p>
                                <label for="password">Mật khẩu <span class="required">*</span></label>
                                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu của bạn" required/>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </p>
                            </div>
                            <div class="form-group">
                                <p>
                                    <label for="password-confirm">Nhập lại mật khẩu <span class="required">*</span></label>
                                    <input id="password-confirm" type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu vừa nhập ở trên">
                                </p>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <p>
                                <label for="name">Họ tên <span class="required">*</span></label>
                                <input id="name" name="name" type="text" placeholder="Nhập tên của bạn" value="{{ old('name') }}" required/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </p>
                            </div>

                        </div>
                        <div class="form-action">
                            <p class="lost_password"><a href="{!! url('login') !!}">Bạn có tài khoản? Đăng nhập</a></p>
                            <input class="btn" type="submit" value="Đăng ký" />
                            <label><a href="{{ url('/password/reset') }}">Bạn quên mật khẩu?</a></label>
                        </div>
                    </form>
                </div>

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
