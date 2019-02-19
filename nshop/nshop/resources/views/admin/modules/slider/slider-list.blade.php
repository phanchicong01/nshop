<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 20-Dec-16
 * Time: 23:28
 */
?>
@extends('admin.master')
@section('title', 'Danh sách sản phẩm')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý slider</a></li>
                <li class="active">Danh sách slider</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh Sách Slider</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="panel panel-primary contact">
                        <div class="panel-body table-responsive">
                            <div class="col-sm-12 text-center">
                                <button type="button" class="btn btn-primary upload" data-toggle="modal" data-target="#myModal"><i class="fa fa-upload" aria-hidden="true"></i> Thêm Hình Mới </button>
                            </div>
                            <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr align="center">
                                    <th>STT</th>
                                    <th>Hình Ảnh</th>
                                    <th>Liên Kết</th>
                                    <th width="20px">Người Đăng</th>
                                    <th width="20px">Trạng Thái</th>
                                    <th width="10px">Sửa</th>
                                    @if(Auth::guard('admin')->user()->level == 1)
                                    <th width="10px">Xóa</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0;?>
                                @foreach($data as $item)
                                    <?php $i++;?>
                                    <tr align="center">
                                        <td>{!! $i !!}</td>
                                        <td><img src="{!! asset('public/images/uploads/sliders/'.$item["image"]) !!}" width="500px"></td>
                                        <td><a href="{!! $item["link"] !!}">{!! $item["link"] !!}</a></td>
                                        <td>{!! $item['user']['name'] !!}</td>
                                        <td>
                                            @if ($item["status"] == 1)
                                                Hiện
                                            @elseif ($item["status"] == 0)
                                                Ẩn
                                            @endif
                                        </td>
                                        <td>
                                            <button value ="{!! $item["id"] !!}" data-toggle="modal" data-target="#myModalEdit" class="btn btn-warning btn-xs edit"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></button>
                                        </td>
                                        @if(Auth::guard('admin')->user()->level == 1)
                                        <td>
                                            <button value="{!! $item["id"] !!}" data-toggle="tooltip" data-placement="bottom" title="Delete item" class="btn btn-danger btn-xs delete-item"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></button>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->

    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title text-center upload" id="myModalLabel">Sửa Hình Ảnh</h2>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="txtImage_Current" class="control-label"> Hình hiện tại</label>
                            <img src="" class="img-responsive" width="300px" alt="">
                            <input type="hidden" class="form-control" name="txtImage_Current" id="txtImage_Current" value="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"><b>Chọn hình mới:</b></label>
                            <input type="file" id="txtImage" name="txtImage" multiple>
                            <p class="help-block">Định dạng hình phải là is jpg, jpeg, png.</p>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"><b>Liên kết:</b></label>
                            <input type="text" name="txtLink" id="txtLink" class="form-control" placeholder="Nhập địa chỉ liên kết" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"><b>Trạng thái</b></label>
                            <label class="radio-inline">
                                <input type="radio" name="txtStatus" id="txtStatus1" value="0">
                                <span class="btn btn-warning">Ẩn</span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="txtStatus" id="txtStatus2" value="1">
                                <span class="btn btn-success">Hiện</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <input type="submit" class="btn btn-primary" value="Cập nhật">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title text-center upload" id="myModalLabel">Đăng Hình Ảnh</h2>
                </div>
                <form action="{!! route('postSliderAdd') !!}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="message-text" class="control-label"><b>Chọn hình ảnh:</b></label>
                            <input type="file" id="txtImage" name="txtImage[]" multiple>
                            <p class="help-block">Định dạng hình phải là jpg, jpeg, png.</p>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"><b>Liên kết:</b></label>
                            <input type="text" name="txtLink" id="txtLink" class="form-control" placeholder="Nhập địa chỉ liên kết" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label"><b>Trạng thái</b></label>
                            <label class="radio-inline">
                                <input type="radio" name="txtStatus" id="txtStatus1" value="0" @if (old('txtStatus') == 0) checked @endif > <span class="btn btn-warning">Ẩn</span>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="txtStatus" id="txtStatus2" value="1"  checked @if (old('txtStatus') == 1) checked @endif > <span class="btn btn-success">Hiện</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <input type="submit" class="btn btn-primary" value="Đăng Hình">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            //==================================== edit =============================================
            $(".edit").click(function () {
                var id = $(this).val();
                $.ajax({
                    url:"edit/"+id,
                    type:'GET',
                    cache:false,
                    data:{"id":id},
                    success:function (data) {
                        var item = $.parseJSON(data);
                        //lấy hết thuộc tính trả về từ database
                        var id_item = item.id;
                        var link_item = item.link;
                        var urlimg_item = item.image;
                        var status_item = item.status;
                        //tìm cái checkbox status
                        var status1 = $("div#myModalEdit").find("#txtStatus1");
                        var status2 = $("div#myModalEdit").find("#txtStatus2");
                        //kiểm tra cái nào có status trùng với database thì checked
                        if(status_item == 0) {
                            $(status1).attr("checked", "true");
                        }else {
                            $(status2).attr("checked", "true");
                        }
                        //thêm hình lấy về từ database vào model
                        $("div#myModalEdit").find("img").attr("src", "../../public/images/uploads/sliders/"+urlimg_item).attr("value", urlimg_item);
                        $("div#myModalEdit").find("#txtImage_Current").val(urlimg_item);
                        //thêm link lấy về từ database vào model
                        $("div#myModalEdit").find("#txtLink").val(link_item);
                        //thêm thuộc tinh action vào form
                        $("div#myModalEdit").find("form").attr("action", "../../nshop-admin/slider/edit/"+id_item);
                    }
                });
            });
            //========================================delete=============================================
            $('.delete-item').click(function () {
                var parent = $(this).parent().parent();
                if(xacnhanxoa('Bạn có chắc chắn muốn xóa hình này?')) {
                    var id = $(this).val();
                    $.ajax({
                        url:"delete/"+id,
                        type:'GET',
                        cache:false,
                        data:{"id":id},
                        success:function (data) {
                            if(data === 'success') {
                                $(parent).fadeOut({
                                    durarion: 300,
                                    done: function () {
                                        $(this).remove();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });

    </script>
    <script>
        function xacnhanxoa (msg) {
            if(window.confirm(msg)) {
                return true;
            }
            return false;
        }
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @if (Session::has('flash_level') && Session::get('flash_level') == 'result_msg')
        <script>
            $(document).ready(function () {
                swal("Thành công!", "{!! Session::get('flash_messages') !!}", "success");
            });
        </script>
    @endif

    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
                $(document).ready(function () {
                    sweetAlert("Oops...", "{!! $error !!}", "error");
                });
            </script>
        @endforeach
    @endif
@endsection