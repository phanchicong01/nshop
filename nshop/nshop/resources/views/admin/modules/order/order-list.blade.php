<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 10-Dec-16
 * Time: 23:52
 */
?>
@extends('admin.master')
@section('title', 'Danh sách đơn hàng')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý đơn hàng</a></li>
                <li class="active">Danh sách đơn hàng</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh Sách Đơn Hàng</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Họ tên</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th width="40">Thanh Toán</th>
                            <th width="40">Tình Trạng</th>
                            <th width="20">Chi tiết</th>
                            @if(Auth::guard('admin')->user()->level == 1)
                            <th width="20">Xóa</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach($data as $item)
                            <tr>
                                <td>{!! ++$i !!}</td>
                                <td>{!! $item["code_order"] !!}</td>
                                <td>
                                    {!! $item["receiver_name"] !!}
                                </td>
                                <td>
                                    {!! $item["receiver_phone"] !!}
                                </td>
                                <td>
                                    {!! $item["receiver_address"] !!}
                                </td>
                                <td>
                                    {!! date('d-m-Y', strtotime($item["created_at"])) !!}
                                </td>
                                <td>
                                    @if ($item["status"] == 0)
                                        <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Chưa thanh toán</span>
                                    @elseif ($item["status"] == 1)
                                        <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Đã thanh toán</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item["status"] == 0)
                                        <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Chưa giao hàng</span>
                                    @elseif ($item["status"] == 1)
                                        <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Đã giao hàng</span>
                                    @endif
                                </td>
                                <td align="center"><a href="{!! route('getOrderDetail', ["id" => $item["id"]]) !!}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                @if(Auth::guard('admin')->user()->level == 1)
                                <td align="center"><a href="{!! route('deleleOrder', ["id" => $item["id"]]) !!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa đơn hàng này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
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
