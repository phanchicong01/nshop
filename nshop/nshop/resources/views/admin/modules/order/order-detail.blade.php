<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 10-Dec-16
 * Time: 23:53
 */
?>

@extends('admin.master')
@section('title', 'Đơn hàng chi tiết')
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
                <li class="active">Đơn hàng chi tiết</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Đơn Hàng Chi Tiết</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="text-center">Chi Tiết Đơn Hàng</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-user-md fa-lg"></i> Khách Hàng</td>
                                        <td>{!! $data["receiver_name"] !!}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i> Ghi Chú </td>
                                        <td>{!! $data["note"] !!}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-credit-card fa-lg" aria-hidden="true"></i> Phương Thức Thanh Toán </td>
                                            <td>{!! $data_payment['name'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-truck fa-lg" aria-hidden="true"></i> Phương Thức Giao Hàng </td>
                                            <td>{!! $data_delivery['name'] !!}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-usd fa-lg" aria-hidden="true"></i> Trạng Thái </td>
                                        <td>
                                            @if ($data["payment"] == 0)
                                                <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Chưa Thanh Toán</span> &nbsp; <a class="btn btn-danger" href="{!! route('ProcessPayment', ['id' => $data["id"]]) !!}"><i class="fa fa-check"></i> Xác nhận đã thanh toán</a>
                                            @elseif ($data["payment"] == 1)
                                                <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Đã Thanh Toán</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-ship" aria-hidden="true"></i> Giao Hàng </td>
                                        <td>
                                            @if ($data["status"] == 0)
                                                <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Chưa Giao Hàng</span> &nbsp; <a class="btn btn-danger" href="{!! route('updateOrder', ['id' => $data["id"]]) !!}"><i class="fa fa-check"></i> Xác nhận đã giao hàng</a>
                                            @elseif ($data["status"] == 1)
                                                <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Đã Giao Hàng</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th>Mã SP</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Size</th>
                                <th>Màu Sắc</th>
                                <th>Số Lượng Mua</th>
                                <th>Đơn Giá</th>
                                <th>Thành Tiền</th>
                            </tr>
                            <?php $sum = 0;?>
                            @foreach($data_detail as $item)
                                <?php
                                        $data_product = \App\Models\Product::where('id', $item['id_product'])->first();
                                ?>
                            <tr>
                                <td>{!! $data_product->code !!}</td>
                                <td>{!! $data_product->name !!}</td>
                                <td>{!! $item['size'] !!}</td>
                                <td>{!! $item['color']  !!}</td>
                                <td>{!! $item['quantity'] !!}</td>
                                <td>{!! number_format($item['price'] , 0, ',', '.') !!}<sup>đ</sup></td>
                                <td>{!! number_format($item['quantity']*$item['price'], 0, ',', '.') !!}<sup>đ</sup></td>
                                <?php $sum+= $item['quantity']*$item['price']?>
                            </tr>
                           @endforeach
                            <tr>
                                <td align="right" class="text-success" colspan="6">
                                    <b>Tổng tiền</b>
                                </td>
                                <td class="text-danger"><b>
                                        {!! number_format($sum, 0, ",", ".")!!}<sup>đ</sup>
                                    </b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-offset-6">
                        <button type="button" onclick="history.back();" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Quay Về</button>
                    </div>
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