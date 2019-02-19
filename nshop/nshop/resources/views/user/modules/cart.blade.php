<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 13-Dec-16
 * Time: 11:07
 */
?>
@extends('user.master')
@section('title', 'Giỏ hàng chi tiết')
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
                        <li class="active">Giỏ hàng chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area start -->
    <div class="cart-main-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Hình</th>
                                    <th class="product-name">Tên Sản Phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số Lượng</th>
                                    <th class="product-subtotal">Thành Tiền</th>
                                    <th class="product-remove">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!count($content))
                                    <tr>
                                        <td colspan="6" align="center">Không có sản phẩm nào trong giỏ hàng
                                        </td>
                                    </tr>
                                @else
                                @foreach($content as $item)
                                <tr>
                                    <td class="product-thumbnail"><a href="#"><img src="{!! asset('public/images/uploads/products/'.$item->options['img']) !!}" alt="" /></a></td>
                                    <td class="product-name"><a href="#">{!! $item->name !!}</a><br>Size: {!! $item->options['size'] !!} @if(isset($item->options['color'])&& $item->options['color'] != ''), Color: {!! $item->options['color'] !!} @endif</td>
                                    <td class="product-price"><span class="amount">{!! number_format($item->price, 0, ",", ".") !!}<sup>đ</sup></span></td>
                                    <td class="product-quantity"><input type="number" value="{!! $item->qty !!}" /></td>
                                    <td class="product-subtotal">{!! number_format($item->price*$item->qty, 0, ",", ".") !!}<sup>đ</sup></td>
                                    <td class="product-remove">
                                        <button type="button" value="{!! $item->rowId !!}" data-toggle="tooltip" data-placement="bottom" title="Xóa" class="btn btn-danger btn-xs delete-item"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        <button type="button" value="{!! $item->rowId !!}" data-toggle="tooltip" data-placement="bottom" title="Cập nhật" class="btn btn-info btn-xs update-item"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">

                                    <a href="javascript:history.back()">Tiếp tục mua hàng</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="cart_totals">
                                    <h2>Tổng cộng</h2>
                                    <table>
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Sản phẩm: </th>
                                            <td><span class="amount">{!! $count_item !!}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Tổng cộng</th>
                                            <td>
                                                <strong><span class="amount">{!! $total !!}<sup>đ</sup></span></strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="clearfix"></div>
                                    <div class="wc-proceed-to-checkout">
                                        @if(\Gloudemans\Shoppingcart\Facades\Cart::total() > 0)
                                        <a href="{!! route('checkOut') !!}">Đặt hàng</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
@endsection
@section('javascript')
    <!-- SweetAlert -->
    <link href="{!! asset('public/vendors/sweetalert2/sweetalert2.min.css') !!}" rel="stylesheet" >
    <script src="{!! asset('public/js/myscript.js') !!}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        $(document).ready(function () {
            $('.delete-item').click(function () {
                var parent = $(this).parent().parent();
                if(xacnhanxoa('Bạn có muốn xóa sản phẩm này?')) {
                    var rowid = $(this).val();
                    $.ajax({
                        url:'remove-item-cart/'+rowid,
                        type:'GET',
                        cache:false,
                        data:{"rowid":rowid},
                        success:function (data) {
                            if(data === 'success') {
                                $(parent).fadeOut({
                                    durarion: 300,
                                    done: function () {
                                        $(this).remove();
                                        issetItem();
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });
        function issetItem() {
            //Kiểm tra xem còn class này không, nếu không tức là không còn thẻ <tr>
            var tag_tr = $.find(".delete-item");
            if(tag_tr == '') {//Nếu không còn thì chèn thông báo
                $("tbody").html("<tr><td colspan='6' class='text-center'>Không có sản phẩm nào trong giỏ hàng</td></tr>");
                $(".contact").remove();
            }
        }

        $('.update-item').click(function () {
            var quantity = $(this).parent().parent().find('input').val();
            var rowid = $(this).val();
            $.ajax({
                url:'update-item-cart/'+rowid+'/'+quantity,
                type:'GET',
                cache:false,
                success:function (data) {
                    if(data === 'success') {
                        alert('Cập nhật thành công!');
                        window.location = "cart"
                    }
                }
            });
        });
        </script>
@endsection