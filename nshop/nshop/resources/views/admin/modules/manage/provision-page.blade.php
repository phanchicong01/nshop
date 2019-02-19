<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 21-Dec-16
 * Time: 11:20
 */
?>

@extends('admin.master')
@section('title', 'Danh sách điều khoản')
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
                    <h2>Quản Lý Điều Khoản</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @foreach ($data as $item)
                            <div class="form-group">
                                <label for="txtDescription" class="col-sm-2 control-label">{!! $item['name'] !!}</label>
                                <div class="col-sm-10 @if ($errors->has('txtContent'.$item['id'])) has-error @endif">
                                    <textarea class="form-control" name="txtContent{!! $item['id'] !!}" id="txtContent{!! $item['id'] !!}">{!! old('txtContent'.$item["id"], isset($item["content"]) ? $item["content"] : null) !!}</textarea>
                                    @if ($errors->has('txtContent'.$item['id']))
                                        <span class="help-block">{{ $errors->first('txtContent'.$item['id']) }}</span>
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
@section('css')
    <!-- iCheck -->
    <link href="{!! asset("public/vendors/iCheck/skins/flat/green.css") !!}" rel="stylesheet">
    {{--CKEditor & CKFinder--}}
    <script type="text/javascript" src="{!! asset('public/vendors/ckeditor/ckeditor.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/vendors/ckfinder/ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/') !!}";
    </script>
@endsection
@section('javascript')
    <script type="text/javascript" src="{!! asset('public/vendors/func_ckfinder.js') !!}"></script>
    <script>
        @for($i = 1; $i <= 4; $i++)
            ckeditor ("txtContent{!! $i !!}");
        @endfor
    </script>
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
