<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 09-Dec-16
 * Time: 09:43
 */
?>
@extends('admin.master')
@section('title', 'Sửa thông tin sản phẩm')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="{!! route('getProductList') !!}">Quản lý sản phẩm</a></li>
                <li class="active">Sửa thông tin sản phẩm</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sửa Thông Tin Sản Phẩm</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtName">Tên sản phẩm <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtName')) has-error @endif">
                                    <input type="text" name="txtName" id="txtName" required="required" class="form-control col-md-7 col-xs-12" value="{!! old('txtName', isset($data["name"]) ? $data["name"] : null) !!}">
                                    @if ($errors->has('txtName'))
                                        <span class="help-block">{{ $errors->first('txtName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtCode">Mã sản phẩm <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtCode')) has-error @endif">
                                    <input type="text" id="txtCode" name="txtCode" required="required" class="form-control col-md-7 col-xs-12"  value="{!! old('txtCode', isset($data["code"]) ? $data["code"] : null) !!}">
                                    @if ($errors->has('txtCode'))
                                        <span class="help-block">{{ $errors->first('txtCode') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12"><span style="color:red">(*)</span> Mã sản phẩm phải nhỏ hơn hoặc bằng 10 ký tự</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtPrice">Giá <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtPrice')) has-error @endif">
                                    <input type="number" id="txtPrice" name="txtPrice" required="required" class="form-control col-md-7 col-xs-12"  value="{!! old('txtPrice', isset($data["price"]) ? $data["price"] : null) !!}">
                                    @if ($errors->has('txtPrice'))
                                        <span class="help-block">{{ $errors->first('txtPrice') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtQuantity">Số lượng <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtQuantity')) has-error @endif">
                                    <input type="number" id="txtQuantity" name="txtQuantity" required="required" class="form-control col-md-7 col-xs-12"  value="{!! old('txtQuantity', isset($data["quantity"]) ? $data["quantity"] : null) !!}">
                                    @if ($errors->has('txtQuantity'))
                                        <span class="help-block">{{ $errors->first('txtQuantity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtContent">Thông tin sản phẩm <span class="required">*</span>
                                </label>
                                <div class="col-xs-10 @if ($errors->has('txtContent')) has-error @endif">
                                    <textarea required class="form-control" name="txtContent" id="txtContent">{!! old('txtContent', isset($data["content"]) ? $data["content"] : null) !!}</textarea>
                                    @if ($errors->has('txtContent'))
                                        <span class="help-block">{{ $errors->first('txtContent') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtPromotion">Khuyến mãi</label>
                                <div class="col-xs-10">
                                    <label><input type="checkbox" name="txtPromotion" id="txtPromotion" value="1" class="flat"  @if(old('txtPromotion') == 1 || (isset($data["promotion"]) && $data["promotion"]!= '')) checked @endif /> <button type="button" class="btn btn-info" id="btnPromotion">Có</button> </label>
                                </div>
                                <div class="col-xs-10 col-xs-offset-2">
                                    <input id="txtPromotionData" type="number" name="txtPromotionData" class="form-control"  value="{!! old('txtPromotionData', isset($data["promotion"]) ? $data["promotion"] : null) !!}" placeholder="Nhập giá trị khuyến mãi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2" for="txtHotProduct">Sản phẩm hot</label>
                                <div class="col-xs-10">
                                    <label><input type="checkbox" name="txtHotProduct" id="txtHotProduct" value="1" class="flat" @if(old('txtHotProduct') == 1 || (isset($data["hot_product"]) && $data["hot_product"] == 1)) checked @endif /> <button type="button" class="btn btn-info">Có</button> </label>
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
                                <label for="txtCategory" class="control-label col-md-2">Danh mục</label>
                                <div class="col-md-10">
                                    <select id="txtCategory" class="form-control" name="txtCategory" required>
                                        <option value="">Chọn danh mục</option>
                                        <?php menuMulti ($cate_data, 0, $str = "--|", $data["id_cate"]); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-group">
                                    <label class="control-label col-md-2" for="txtSize">Kích cỡ</label>
                                    <div class="col-md-10">
                                        <?php
                                            $size = '';
                                            foreach ($size_data as $size_item)
                                                $size .= $size_item["size"].',';
                                        ?>
                                        <input id="txtSize" type="text" name="txtSize" class="tags form-control" value="{!! old('txtSize', isset($size_data) ? $size : null) !!}" placeholder="Nhập vào kích cỡ của sản phẩm" />
                                        <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-group">
                                    <label class="control-label col-md-2" for="txtColor">Màu sắc</label>
                                    <div class="col-md-10">
                                        <?php
                                        $color = '';
                                        foreach ($color_data as $color_item)
                                            $color .= $color_item["color"].',';
                                        ?>
                                        <input id="txtColor" type="text" name="txtColor" class="tags form-control" value="{!! old('txtColor', isset($color_data) ? $color : null) !!}"  placeholder="Nhập vào màu của sản phẩm" />
                                        <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="text-center"><b>Hình hiện tại</b></div>
                                    <div id="list-image">
                                        @foreach($image_data as $image)
                                            <div class="col-md-10">
                                                <img src="{!! $image['image']!= '' ? asset('public/images/uploads/products/'.$image['image']) : asset('public/images/icons/no-photo.png') !!}" class="img-responsive" id="image-{!! $image["id"] !!}" alt="">
                                            </div>
                                            <div class="col-md-2" style="padding: 5px">
                                                @if($image["image"]!= '')
                                                    <button type="button" data-image="{!! $image["image"] !!}" data-id-image="{!! $image["id"] !!}" class="btn btn-danger delete-image-current"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtImage" class="control-label col-md-2">Hình sản phẩm</label>
                                <div class="col-md-10  @if ($errors->has('txtImage')) has-error @endif">
                                    <div id="area-image">
                                        <input id="txtImage" class="form-control col-md-7 col-xs-12" type="file" name="txtImage[]" multiple >
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
                                    <div class="preview-area"></div>
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
    <!-- jQuery Tags Input -->
    <script src="{!! asset("public/vendors/jquery.tagsinput/src/jquery.tagsinput.js") !!}"></script>
    <!-- jQuery Tags Input -->
    <script>
        function onAddTag(tag) {
            alert("Thêm size mới: " + tag);
        }

        function onRemoveTag(tag) {
            alert("Xóa size này: " + tag);
        }

        function onChangeTag(input, tag) {
            alert("Thay đổi size: " + tag);
        }

        $(document).ready(function() {
            $('#txtSize').tagsInput({
                width: 'auto'
            });
            $('#txtColor').tagsInput({
                width: 'auto'

            });
        });
    </script>
    <!-- /jQuery Tags Input -->
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
            //Delete imgae current
            $('.delete-image-current').click(function () {
                if (xacnhanxoa('Bạn có chắc muốn xóa hình này?')) {
                    var obj = $(this);
                    var id = obj.attr("data-id-image");
                    var image = obj.attr("data-image");
                    $.ajax({
                        url:'../delete-image-product/'+id+'/'+image,
                        type:'GET',
                        cache:false,
                        success:function (data) {
                            if(data == 'success') {
                                $('#image-'+id).fadeOut({
                                    durarion: 300,
                                    done: function () {
                                        obj.remove();
                                        issetItem();
                                    }
                                });

                            }
                        }
                    });
                }
            });
            issetItem();
        });
        function issetItem() {
            var btn_delete = $.find(".delete-image-current");
            if(btn_delete == '') {
                $("#list-image").html("<p class='text-center'>Không có hình nào!</p>");
                $("#area-image").html('<input id="txtImage" class="form-control col-md-7 col-xs-12" type="file" name="txtImage[]" multiple required />');
            }
        }
        $(document).ready(function () {
            $('#txtPromotionData').hide();
            @if($data['promotion'] != '')
                $('#txtPromotionData').show();
            @endif
            $('#btnPromotion').click(function () {
                $('#txtPromotionData').slideToggle();
            })
        })
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
    {{--Preview for multiple images selected in file uploaded--}}
    <script>
        var inputLocalFont = document.getElementById("txtImage");
        inputLocalFont.addEventListener("change",previewImages,false);

        function previewImages(){
            var fileList = this.files;

            var anyWindow = window.URL || window.webkitURL;

            for(var i = 0; i < fileList.length; i++){
                var objectUrl = anyWindow.createObjectURL(fileList[i]);
                $('.preview-area').append('<img class="img-responsive center-block" src="' + objectUrl + '" />');
                window.URL.revokeObjectURL(fileList[i]);
            }
        }
    </script>
@endsection
