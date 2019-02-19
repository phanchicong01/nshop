<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 20-Dec-16
 * Time: 11:17
 */
?>
@extends('user.master')
@section('title', 'Cập nhật thông tin tài khoản')
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
                        <li class="active">Cập nhật thông tin tài khoản</li>
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
                                    <li><a href="{!! route('getCustomerProfile', ['id' => \Illuminate\Support\Facades\Auth::guard('user')->user()->id]) !!}"> <i class="fa fa-home" aria-hidden="true"></i> Tổng quan </a></li>
                                    <li class="active"><a href="#"> <i class="fa fa-cog" aria-hidden="true"></i> Cài đặt tài khoản </a></li>
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
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase"><span style="font-weight: bold; text-transform: uppercase">Thông Tin Tài Khoản</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1_1" data-toggle="tab">Thông Tin Cá Nhân</a></li>
                                <li><a href="#tab_1_2" data-toggle="tab">Thay Đổi Avatar</a></li>
                                <li><a href="#tab_1_3" data-toggle="tab">Thay Đổi Mật Khẩu</a></li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form action="{!! route('postCustomerProfileEdit') !!}" method="POST" id="form-input" data-parsley-validate class="form-horizontal">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="idUser" value="{!! \Illuminate\Support\Facades\Auth::guard('user')->user()->id !!}">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtName">Họ tên <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 @if ($errors->has('txtName')) has-error @endif">
                                                <input type="text" id="txtName" name="txtName" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtName', isset($data["name"]) ? $data["name"] : null) !!}">
                                                @if ($errors->has('txtName'))
                                                    <span class="help-block">{{ $errors->first('txtName') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtPhone" class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input id="txtPhone" class="form-control col-md-7 col-xs-12" type="text" name="txtPhone" value="{!! old('txtPhone', isset($data["phone"]) ? $data["phone"] : null) !!}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtAddress" class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input id="txtAddress" class="form-control col-md-7 col-xs-12" type="text" name="txtAddress" value="{!! old('txtAddress', isset($data["address"]) ? $data["address"] : null) !!}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày sinh</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input id="txtBirthday" type="text" name="txtBirthday" class="date-picker form-control" data-inputmask="'mask': '99/99/9999'"  value="{!! old('txtBirthday', isset($data["birthday"]) ? date('dmY', strtotime($data["birthday"])) : null) !!}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Giới tính</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <label><input type="radio"  name="txtGender" id="genderM" value="1" checked="" required /> Nam</label>
                                                    <label><input type="radio"  name="txtGender" id="genderF" value="0" @if(isset($data["gender"]) && $data["gender"] == 0) checked @endif/> Nữ</label>
                                            </div>
                                        </div>
                                        <div class="margiv-top-10 text-center">
                                            <input type="submit" class="btn btn-primary" value="Cập nhật">
                                            <input type="reset" class="btn default" value="Hủy">
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <p class="text-center" style="font-size: 20px">
                                        <b>Avatar Hiện Tại</b>
                                    </p>
                                    <form action="{!! route('postCustomerProfileEditAvatar') !!}" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="idUser" value="{!! \Illuminate\Support\Facades\Auth::guard('user')->user()->id !!}">
                                        <input type="hidden" name="txtAvatar_Current" value="{!! $data["avatar"] !!}">
                                        <div class="form-group text-center">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div style="width: 200px; height: 150px;margin:auto; display: table">
                                                    <img src="@if($data["avatar"] != '') {!! asset('public/images/uploads/users/'.$data['avatar']) !!} @else {!! asset('public/images/icons/avatar2.png') !!} @endif" class="img-responsive" width="100%" alt="">
                                                </div>
                                                <br>
                                                <div class="clearfix margin-top-20 @if ($errors->has('txtAvatar')) has-error @endif"">
                                                    <span class="btn default btn-file">
                                                    <span style="color: #1F568B; font-weight: bold; text-transform: uppercase;">
                                                    Chọn hình ảnh </span>
                                                    <input type="file" name="txtAvatar" required>
                                                        @if ($errors->has('txtAvatar'))
                                                            <span class="help-block">{{ $errors->first('txtAvatar') }}</span>
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-danger">Chú ý! </span>
                                                <span> &nbsp;Định dạng hình phải là .jpg, png, jpeg</span>
                                            </div>
                                        </div>
                                        <div class="margin-top-10 text-center">
                                            <input type="submit" class="btn btn-primary" value="Cập nhật">
                                            <input type="reset" class="btn default" value="Hủy">
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="{!! route('postCustomerProfileEditPassword') !!}" method="POST" id="form-input-pass" data-parsley-validate class="form-horizontal form-label-left" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="idUser" value="{!! \Illuminate\Support\Facades\Auth::guard('user')->user()->id !!}">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPassword">Mật khẩu hiện tại <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 @if ($errors->has('txtPassword')) has-error @endif">
                                                <input type="password" id="txtPassword" name="txtPassword" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nhập mật khẩu hiện tại">
                                                @if ($errors->has('txtPassword'))
                                                    <span class="help-block">{{ $errors->first('txtPassword') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPasswordNew">Mật khẩu mới <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 @if ($errors->has('txtPasswordNew')) has-error @endif">
                                                <input type="password" id="txtPasswordNew" name="txtPasswordNew" class="form-control col-md-7 col-xs-12" required placeholder="Nhập mật khẩu mới">
                                                @if ($errors->has('txtPasswordNew'))
                                                    <span class="help-block">{{ $errors->first('txtPasswordNew') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRePasswordNew">Nhập lại mật khẩu mới<span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 @if ($errors->has('txtRePasswordNew')) has-error @endif">
                                                <input type="password" id="txtRePasswordNew" name="txtRePasswordNew" class="form-control col-md-7 col-xs-12" required placeholder="Nhập lại mật khẩu mới">
                                                @if ($errors->has('txtRePasswordNew'))
                                                    <span class="help-block">{{ $errors->first('txtRePasswordNew') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="margin-top-10 text-center">
                                            <input type="submit" class="btn btn-primary" value="Thay Đổi Mật Khẩu">
                                            <input type="reset" class="btn default" value="Hủy">
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET -->
                </div>
                <!-- END PORTLET -->
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @if (Session::has('flash_level') && Session::get('flash_level') == 'result_msg')
        <script>
            $(document).ready(function () {
                swal("Thành Công!", "{!! Session::get('flash_messages') !!}", "success");
            });
        </script>
    @endif
    @if(Session::has('flash_level') && Session::get('flash_level') == 'error_msg')
        <script type="text/javascript">
            $(document).ready(function () {
                sweetAlert("Oops...", "{!! Session::get('flash_messages') !!}", "error");
            });
        </script>
    @endif
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
    <!-- bootstrap-daterangepicker -->
    <script src="{!! asset("public/vendors/moment/min/moment.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/bootstrap-daterangepicker/daterangepicker.js") !!}"></script>
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
    <!-- jquery.inputmask -->
    <script src="{!! asset("public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js") !!}"></script>
    <!-- jquery.inputmask -->
    <script>
        $(document).ready(function() {
            $(":input").inputmask();
        });
    </script>
    <!-- /jquery.inputmask -->
    <!-- bootstrap-daterangepicker -->
    <script>
        $(document).ready(function() {
            $('#txtBirthday').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                calender_style: "picker_4",
                locale: {
                    format: 'DD/MM/YYYY',
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "daysOfWeek": [
                        "Chủ Nhật",
                        "Hai",
                        "Ba",
                        "Tư",
                        "Năm",
                        "Sáu",
                        "Bảy"
                    ],
                    "monthNames": [
                        "Tháng 1",
                        "Tháng 2",
                        "Tháng 3",
                        "Tháng 4",
                        "Tháng 5",
                        "Tháng 6",
                        "Tháng 7",
                        "Tháng 8",
                        "Tháng 9",
                        "Tháng 10",
                        "Tháng 11",
                        "Tháng 12"
                    ]
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <!-- /bootstrap-daterangepicker -->

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
            $('#form-input-pass .btn').on('click', function() {
                $('#form-input').parsley().validate();
                validateFront();
            });
            var validateFront = function() {
                if (true === $('#form-input-pass').parsley().isValid()) {
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