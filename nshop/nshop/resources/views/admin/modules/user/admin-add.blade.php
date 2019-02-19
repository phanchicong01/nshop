<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.comm
 * Date: 07-Dec-16
 * Time: 14:36
 */
?>
@extends('admin.master')
@section('title', 'Thêm tài khoản quản trị website | Admin')
@section('keywords', '')
@section('description', '')
@section('content')
<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
            </li>
            <li><a href="{!! route('getAdminList') !!}">Quản lý user</a></li>
            <li class="active">Thêm nhân viên mới</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm Nhân Viên Mới</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEmail">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 @if ($errors->has('txtEmail')) has-error @endif">
                                <input type="email" name="txtEmail" id="txtEmail" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtEmail') !!}">
                                @if ($errors->has('txtEmail'))
                                    <span class="help-block">{{ $errors->first('txtEmail') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPassword">Mật khẩu <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 @if ($errors->has('txtPassword')) has-error @endif">
                                <input type="password" id="txtPassword" name="txtPassword" required="required" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('txtPassword'))
                                    <span class="help-block">{{ $errors->first('txtPassword') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRePassword">Nhập lại mật khẩu <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 @if ($errors->has('txtRePassword')) has-error @endif">
                                <input type="password" id="txtRePassword" name="txtRePassword" required="required" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('txtRePassword'))
                                    <span class="help-block">{{ $errors->first('txtRePassword') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtName">Họ tên <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 @if ($errors->has('txtName')) has-error @endif">
                                <input type="text" id="txtName" name="txtName" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtName') !!}">
                                @if ($errors->has('txtName'))
                                    <span class="help-block">{{ $errors->first('txtName') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtPhone" class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="txtPhone" class="form-control col-md-7 col-xs-12" type="text" name="txtPhone" value="{!! old('txtPhone') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Ngày sinh</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="txtBirthday" type="text" name="txtBirthday" class="date-picker form-control" data-inputmask="'mask': '99/99/9999'"  value="{!! old('txtBirthday') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Giới tính</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label><input type="radio" class="flat" name="txtGender" id="genderM" value="1" checked="" required /> Nam</label>
                                    <label><input type="radio" class="flat" name="txtGender" id="genderF" value="0" @if(old('txtGender') == 0) checked @endif/> Nữ</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtAddress" class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="txtAddress" class="form-control col-md-7 col-xs-12" type="text" name="txtAddress" value="{!! old('txtAddress') !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtLevel" class="control-label col-md-3 col-sm-3 col-xs-12">Quyền hạn</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="heard" class="form-control" name="txtLevel" required>
                                    <option value="1">Admin</option>
                                    <option value="2" @if(old('txtLevel') == 2) selected @endif>Mod</option>
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="txtAvatar" class="control-label col-md-3 col-sm-3 col-xs-12">Hình đại diện</label>
                            <div class="col-md-9 col-sm-9 col-xs-12  @if ($errors->has('txtAvatar')) has-error @endif">
                                <input id="txtAvatar" class="form-control col-md-7 col-xs-12" type="file" name="txtAvatar" value="{!! old('txtAvatar') !!}">
                                @if ($errors->has('txtAvatar'))
                                    <span class="help-block">{{ $errors->first('txtAvatar') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12"><span style="color:red">(*)</span> Định dạng của hình ảnh phải là jpg, jpeg, png</div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <img src="" id="target" width="280" class="img-responsive center-block"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <button type="reset" class="btn btn-warning">Hủy</button>
                            <button type="submit" class="btn btn-success">Đồng ý</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('css')
    <!-- iCheck -->
    <link href="{!! asset("public/vendors/iCheck/skins/flat/green.css") !!}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{!! asset("public/vendors/bootstrap-daterangepicker/daterangepicker.css") !!}" rel="stylesheet">
@endsection
@section('javascript')
    <!-- My script -->
    <script src="{!! asset('public/js/myscript.js') !!}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{!! asset("public/vendors/moment/min/moment.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/bootstrap-daterangepicker/daterangepicker.js") !!}"></script>
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
    <!-- iCheck -->
    <script src="{!! asset("public/vendors/iCheck/icheck.min.js") !!}"></script>
    <!-- jquery.inputmask -->
    <script src="{!! asset("public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js") !!}"></script>
    <script>
        var src = document.getElementById("txtAvatar");
        var target = document.getElementById("target");
        showImage(src,target);
    </script>
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
                    format: 'DD-MM-YYYY',
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
        });
        try {
            hljs.initHighlightingOnLoad();
        } catch (err) {}
    </script>
    <!-- /Parsley -->
@endsection