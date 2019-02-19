<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 09-Dec-16
 * Time: 07:42
 */
?>
@extends('admin.master')
@section('title', 'Sửa danh mục | Admin')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="{!! route('getCateList') !!}">Quản lý danh mục</a></li>
                <li class="active">Sửa danh mục</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sửa Danh Mục</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="txtParent" class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục cha</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="txtParent" class="form-control" name="txtParent" required>
                                        <option value="0">Không có</option>
                                        <?php menuMulti ($data_cate, 0, $str = "--|", $data['id_parent'])?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtName">Tên danh mục <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 @if ($errors->has('txtName')) has-error @endif">
                                    <input type="text" name="txtName" id="txtName" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtName', isset($data["name"]) ? $data["name"] : null) !!}">
                                    @if ($errors->has('txtName'))
                                        <span class="help-block">{{ $errors->first('txtName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtStatus" class="control-label col-md-3 col-sm-3 col-xs-12">Trạng thái</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label><input type="checkbox" name="txtStatus" id="txtStatus" value="1" class="flat" @if(old('txtStatus') == 1 || (isset($data["status"]) && $data["status"] == 1)) checked @endif /> Hiện</label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
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
@endsection
@section('javascript')
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
    <!-- iCheck -->
    <script src="{!! asset("public/vendors/iCheck/icheck.min.js") !!}"></script>
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
