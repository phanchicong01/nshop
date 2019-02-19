<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 13-Dec-16
 * Time: 12:59
 */
?>
@extends('user.master')
@section('title', 'Thông tin đặt hàng')
@section('keywords', '')
@section('description', '')
@section('content-main')
    <div id="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{!! route('index') !!}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                        </li>
                        <li class="active">Chi tiết đặt hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- coupon-area start -->
    <!-- coupon-area end -->
    <!-- checkout-area start -->
    <div class="row">
        <div class="col-md-offset-2 col-md-8 col-sm-8 col-xs-8">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Chi tiết đơn hàng</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background-color: #2f2f2f;">
                            <h4 class="text-center" style="color: #fff">Chi Tiết Đơn Hàng</h4>
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
                                            <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Chưa Thanh Toán</span> &nbsp;
                                            {{--<a class="btn btn-danger" href="{!! route('ProcessPayment', ['id' => $data["id"]]) !!}"><i class="fa fa-check"></i> Xác nhận đã thanh toán</a>--}}
                                        @elseif ($data["payment"] == 1)
                                            <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Đã Thanh Toán</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-ship" aria-hidden="true"></i> Giao Hàng </td>
                                    <td>
                                        @if ($data["status"] == 0)
                                            <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Chưa Giao Hàng</span> &nbsp;
                                            {{--<a class="btn btn-danger" href="{!! route('updateOrder', ['id' => $data["id"]]) !!}"><i class="fa fa-check"></i> Xác nhận đã giao hàng</a>--}}
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

                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
@section('javascript')
    <!-- Parsley -->
    <script src="{!! asset("public/vendors/parsleyjs/dist/parsley.min.js") !!}"></script>
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