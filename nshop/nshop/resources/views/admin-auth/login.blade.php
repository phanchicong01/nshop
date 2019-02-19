<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 06-Dec-16
 * Time: 09:37
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

    <title>Login | Admin </title>
    <link href="{!! asset('public/images/icons/favicon.ico') !!}" rel="shortcut icon" >
    <!-- Bootstrap -->
    <link href="{!! asset('public/vendors/bootstrap/dist/css/bootstrap.min.css') !!}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{!! asset('public/vendors/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet">

    <!-- Animate.css -->
    <link href="{!! asset('public/vendors/animate.css/animate.min.css') !!}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{!! asset('public/css/custom.min.css') !!}" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="{{ url('/nshop-login') }}" method="post">
                    {{ csrf_field() }}
                    <h1>Đăng nhập</h1>
                    @include('errors.flash-error')
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" value="{!! old('email') !!}" autofocus/>
                        @if ($errors->has('email'))
                            <span class="help-block"><i class="fa fa-bell-o"></i> {{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Mật khẩu" required="" />
                        @if ($errors->has('password'))
                            <span class="help-block"><i class="fa fa-bell-o"></i> {{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Đăng nhập</button>
                        <a href="{{ url('/nshop-password/reset') }}" class="reset_pass">Bạn quên mật khẩu?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw"></i> Nshop Control Panel!</h1>
                            <p>©2016 All Rights Reserved. Chí Công</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="{!! asset('public/vendors/jquery/dist/jquery.min.js') !!}"></script>
<!-- Bootstrap -->
<script src="{!! asset('public/vendors/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
<script>
    $(document).ready(function () {
        $('div.has-error').each(function() {
            $(this).find('input').keyup(function () {
                $(this).closest('div').removeClass('has-error');
                $(this).parent().find(".help-block").slideUp(300);
            });
        });
    });
</script>
@yield('javascript')
</body>
</html>

