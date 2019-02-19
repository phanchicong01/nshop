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
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                            <div class="panel panel-default">
                                <div class="panel-heading">Khôi phục mật khẩu</div>
                                <div class="panel-body">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/nshop-password/email') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class=" control-label">Địa chỉ email</label>


                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif

                                        </div>

                                        <div class="form-group">

                                                <button type="submit" class="btn btn-primary">
                                                    Gửi Link Khôi Phục Mật Khẩu
                                                </button>

                                        </div>
                                    </form>
                                </div>
                            </div>


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
