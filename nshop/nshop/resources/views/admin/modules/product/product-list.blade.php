<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 09-Dec-16
 * Time: 09:43
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
                <li><a href="#">Quản lý sản phẩm</a></li>
                <li class="active">Danh sách sản phẩm</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh Sách Sản Phẩm</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Mã sản phẩm</th>
                            <th>Hình</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Size</th>
                            <th>Màu sắc</th>
                            <th>Khuyến mãi</th>
                            <th width="40">Sản phẩm hot</th>
                            <th width="40">Trạng thái</th>
                            <th>Danh mục</th>
                            <th>Người đăng</th>
                            <th width="20">Xem</th>
                            <th width="20">Sửa</th>
                            @if(Auth::guard('admin')->user()->level == 1)
                            <th width="20">Xóa</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <?php $num = 0;?>
                        @foreach($data as $item)
                            <tr>
                                <td>{!! ++$num !!}</td>
                                <td>{!! $item["name"] !!}</td>
                                <td>{!! $item["code"] !!}</td>
                                <td>
                                    <?php
                                        $image_data = getImageProduct($item["id"]);
                                    ?>
                                    @if($image_data != '')
                                        <img src="{!! $image_data->image!= '' ? asset('public/images/uploads/products/'.$image_data->image) : asset('public/images/icons/no-photo.png') !!}" width="80px" height="80px" class="img-responsive">
                                    @else
                                        <img src="{!! asset('public/images/icons/no-photo.png') !!}" width="80px" height="80px" class="img-responsive">
                                    @endif
                                </td>
                                <td>{!! number_format($item["price"]) !!} <sup>đ</sup></td>
                                <td>{!! $item["quantity"] !!}</td>
                                <td>
                                    <?php
                                    $size_data = getSizeProduct($item["id"]);
                                    $i = 0;
                                    ?>
                                    @foreach($size_data as $size_item)
                                        @if($i != 0), @endif <?php $i = 1;?> {!! $size_item["size"] !!}
                                    @endforeach
                                </td>
                                <td>
                                    <?php
                                    $color_data = getColorProduct($item["id"]);
                                    $i = 0;
                                    ?>
                                    @foreach($color_data as $color_item)
                                            @if($i != 0), @endif <?php $i = 1;?> {!! $color_item["color"] !!}
                                    @endforeach
                                </td>
                                <td>{!! $item["promotion"] !!}</td>
                                <td>
                                    @if ($item["hot_product"] == 0)
                                        <span style="color:red; font-weight: bold;">Không</span>
                                    @else
                                        <span style="color:blue; font-weight: bold;">Có</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item["status"] == 0)
                                        <span style="color:red; font-weight: bold;">Ẩn</span>
                                    @else
                                        <span style="color:blue; font-weight: bold;">Hiện</span>
                                    @endif
                                </td>
                                <td>{!! $item["cate"]["name"] !!}</td>
                                <td>{!! $item["user"]["name"] !!}</td>
                                <td align="center"><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
                                <td align="center"><a href="{!! route('getProductEdit', ["id" => $item["id"]]) !!}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                                @if(Auth::guard('admin')->user()->level == 1)
                                <td align="center"><a href="{!! route('getProductDel', ["id" => $item["id"]]) !!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa sản phẩm này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <!-- Datatables -->
    <link href="{!! asset("public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") !!}" rel="stylesheet">
    <link href="{!! asset("public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") !!}" rel="stylesheet">
@endsection
@section('javascript')
    <!-- Datatables -->
    <script src="{!! asset("public/vendors/datatables.net/js/jquery.dataTables.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js") !!}"></script>

    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            $('#datatable-responsive').DataTable();
        });
    </script>
    <!-- /Datatables -->
    <!-- My script -->
    <script src="{!! asset('public/js/myscript.js') !!}"></script>
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
