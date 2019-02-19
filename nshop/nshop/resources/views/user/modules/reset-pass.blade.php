<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 22:51
 */
?>
@extends('user.master')
@section('title', 'Đăng nhập')
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
                        <li class="active">Khôi phục mật khẩu</li>
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
                    <form action="{{ url('/password/reset') }}" method="post" id="form-input">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-fields">
                            <h2>Khôi phục mật khẩu</h2>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul class="error_msg">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <p>
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input id="email" name="email" type="email" placeholder="Nhập địa chỉ email" required value="{{ $email or old('email') }}" autofocus/>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </p>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <p>
                                <label for="password">Mật khẩu mới</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <p>
                                <label for="password-confirm">Nhập lại mật khẩu</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </p>
                            </div>

                        </div>
                        <div class="form-action">
                            <input class="btn" type="submit" value="Đồng ý" />
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
