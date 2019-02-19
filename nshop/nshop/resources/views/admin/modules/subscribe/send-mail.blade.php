<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.comom
 * Date: 21-Dec-16
 * Time: 22:44
 */
?>
@extends('admin.master')
@section('title', 'Gửi Mail Cho Khách Hàng')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý danh sách email subscribe</a></li>
                <li class="active">Gửi mail</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Gửi Mail Cho Khách Hàng</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtGroup" class="control-label col-md-2">Chọn Nhóm Cần Gửi</label>
                                <div class="col-md-10">
                                    <select id="txtGroup" class="form-control" name="txtGroup" required>
                                        <option value="1">Gửi Cho Người Dùng Đăng Ký</option>
                                        <option value="2">Gửi Cho Khách Hàng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtName">Tiêu đề <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtName')) has-error @endif">
                                    <input type="text" name="txtName" id="txtName" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtName') !!}">
                                    @if ($errors->has('txtName'))
                                        <span class="help-block">{{ $errors->first('txtName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtContent">Nội dung<span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtContent')) has-error @endif">
                                    <textarea required class="form-control" name="txtContent" id="txtContent">{!! old('txtContent') !!}</textarea>
                                    @if ($errors->has('txtContent'))
                                        <span class="help-block">{{ $errors->first('txtContent') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <button type="reset" class="btn btn-warning">Hủy</button>
                                <button type="submit" class="btn btn-success">Gửi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    {{--CKEditor & CKFinder--}}
    <script type="text/javascript" src="{!! asset('public/vendors/ckeditor/ckeditor.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/vendors/ckfinder/ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/') !!}";
    </script>
@endsection
@section('javascript')
    <script type="text/javascript" src="{!! asset('public/vendors/func_ckfinder.js') !!}"></script>
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
   <script>
       ckeditor ("txtContent");
   </script>
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
