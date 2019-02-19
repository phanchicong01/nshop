<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 10-Dec-16
 * Time: 18:15
 */
?>

@extends('admin.master')
@section('title', 'Sửa nội dung tin')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="{!! route('getNewsList') !!}">Quản lý tin tức</a></li>
                <li class="active">Sửa nội dung tin</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sửa Nội Dung Tin</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtName">Tiêu đề <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtName')) has-error @endif">
                                    <input type="text" name="txtName" id="txtName" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtName', isset($data["name"]) ? $data["name"] : null) !!}">
                                    @if ($errors->has('txtName'))
                                        <span class="help-block">{{ $errors->first('txtName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtIntro">Tóm tắt <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtIntro')) has-error @endif">
                                    <textarea required class="form-control" name="txtIntro" id="txtIntro">{!! old('txtIntro', isset($data["intro"]) ? $data["intro"] : null) !!}</textarea>
                                    @if ($errors->has('txtIntro'))
                                        <span class="help-block">{{ $errors->first('txtIntro') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtContent">Nội dung <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtContent')) has-error @endif">
                                    <textarea required class="form-control" name="txtContent" id="txtContent">{!! old('txtContent', isset($data["content"]) ? $data["content"] : null) !!}</textarea>
                                    @if ($errors->has('txtContent'))
                                        <span class="help-block">{{ $errors->first('txtContent') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtStatus">Trạng thái</label>
                                <div class="col-xs-10">
                                    <label><input type="checkbox" name="txtStatus" id="txtStatus" value="1" class="flat" @if(old('txtStatus') == 1 || (isset($data["status"]) && $data["status"] == 1)) checked @endif /> <button type="button" class="btn btn-info">Hiện</button> </label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtDescription">Mô tả
                                </label>
                                <div class="col-xs-10">
                                    <input type="text" name="txtDescription" id="txtDescription" class="form-control col-md-7 col-xs-12" value="{!! old('txtDescription', isset($data["description"]) ? $data["description"] : null) !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtKeyword">Từ khóa
                                </label>
                                <div class="col-xs-10">
                                    <input type="text" name="txtKeyword" id="txtKeyword" class="form-control col-md-7 col-xs-12" value="{!! old('txtKeyword', isset($data["keyword"]) ? $data["keyword"] : null) !!}">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="text-center"><b>Hình hiện tại</b></div>
                                    <img src="{!! $data['image']!= '' ? asset('public/images/uploads/news/'.$data['image']) : asset('public/images/icons/no-photo.png') !!}" class="img-responsive" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtImage" class="control-label col-md-2">Hình tin tức</label>
                                <div class="col-md-10  @if ($errors->has('txtImage')) has-error @endif">
                                    <div id="area-image">
                                        <input id="txtImage" class="form-control col-md-7 col-xs-12" type="file" name="txtImage" />
                                    </div>
                                    @if ($errors->has('txtImage'))
                                        <span class="help-block">{{ $errors->first('txtImage') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12"><span style="color:red">(*)</span> Định dạng của hình ảnh phải là jpg, jpeg, png</div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="text-center"><b>Xem hình trước khi upload</b></div>
                                    <div class="preview-area">
                                        <img src="" id="target" width="280" class="img-responsive center-block"/>
                                    </div>
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
    {{--CKEditor & CKFinder--}}
    <script type="text/javascript" src="{!! asset('public/vendors/ckeditor/ckeditor.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('public/vendors/ckfinder/ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/') !!}";
    </script>
@endsection
@section('javascript')
    <script type="text/javascript" src="{!! asset('public/vendors/func_ckfinder.js') !!}"></script>
    <!-- My script -->
    <script src="{!! asset('public/js/myscript.js') !!}"></script>
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
    <!-- iCheck -->
    <script src="{!! asset("public/vendors/iCheck/icheck.min.js") !!}"></script>
    <script>
        var src = document.getElementById("txtImage");
        var target = document.getElementById("target");
        showImage(src,target);
    </script>
    <script>
        ckeditor ("txtContent");
        $(document).ready(function () {
            $('div.has-error').each(function() {
                $(this).find('input').change(function () {
                    $(this).closest('div').removeClass('has-error').addClass('has-success');
                    $(this).parent().find(".help-block").css("display", "none");
                });
                $(this).find('select').change(function () {
                    $(this).closest('div').removeClass('has-error').addClass('has-success');
                    $(this).parent().find(".help-block").css("display", "none");
                });
            });
        });
    </script>
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