<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 21-Dec-16
 * Time: 11:03
 */
?>
@extends('admin.master')
@section('title', 'Danh sách tin tức')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý trang</a></li>
                <li class="active">Quản lý thông tin trang</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Quản Lý Thông Tin Trang</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach ($data as $item)
                            <div class="form-group">
                                <label for="txtTitle" class="col-sm-2 control-label">Tiêu đề trang</label>
                                <div class="col-sm-9 @if ($errors->has('txtTitle')) has-error @endif">
                                    <textarea class="form-control" name="txtTitle" id="txtTitle">{!! old('txtTitle', isset($item["title"]) ? $item["title"] : null) !!}</textarea>
                                    @if ($errors->has('txtTitle'))
                                        <span class="help-block">{{ $errors->first('txtTitle') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtKeyword" class="col-sm-2 control-label">Từ khóa</label>
                                <div class="col-sm-9 @if ($errors->has('txtKeyword')) has-error @endif">
                                    <textarea class="form-control" name="txtKeyword" id="txtKeyword">{!! old('txtKeyword', isset($item["keyword"]) ? $item["keyword"] : null) !!}</textarea>
                                    @if ($errors->has('txtKeyword'))
                                        <span class="help-block">{{ $errors->first('txtKeyword') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtDescription" class="col-sm-2 control-label">Mô tả</label>
                                <div class="col-sm-9 @if ($errors->has('txtDescription')) has-error @endif">
                                    <textarea class="form-control" name="txtDescription" id="txtDescription">{!! old('txtDescription', isset($item["description"]) ? $item["description"] : null) !!}</textarea>
                                    @if ($errors->has('txtDescription'))
                                        <span class="help-block">{{ $errors->first('txtDescription') }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6 col-md-offset-5">
                            <button type="submit" class="btn btn-success">Cập Nhật</button>
                            <button type="button" onclick="history.back();" class="btn btn-danger">Quay Về</button>
                        </div>
                    </form>
                </div>
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
@endsection