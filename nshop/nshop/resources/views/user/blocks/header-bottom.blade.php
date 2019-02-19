<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:31
 */
?>

<div class="header-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="logo">
                    <a href="{!! route('index') !!}"><img src="{!! asset('public/images/logo/logo.png') !!}" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 hidden-xs">
                <div class="header-search">
                    <form action="{!! route('getSearchProduct') !!}" method="get">
                    <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." />
                    <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 pad-left">
                <div class="total-cart">
                    <div class="cart-toggler">
                        <a href="#">
                            <span class="cart-title"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></span>
                            <span class="cart-quantity">{!! \Gloudemans\Shoppingcart\Facades\Cart::count() !!} sản phẩm</span>
                        </a>
                        <a class="checkout" href="{!! route('getCart') !!}">Xem</a>
                    </div>
                    <ul>
                        <?php
                        $cart_content = \Gloudemans\Shoppingcart\Facades\Cart::content();
                        ?>
                        @foreach($cart_content as $item)
                        <li>
                            <div class="cart-img">
                                <a href="#"><img src="{!! asset('public/images/uploads/products/'.$item->options['img']) !!}" alt="" /></a>
                                <span>{!! $item->qty !!}</span>
                            </div>
                            <div class="cart-info">
                                <h4><a href="#">{!! $item->name !!}</a></h4>
                                <span>{!! number_format($item->price, 0, ",", ".") !!} <span>x {!! $item->qty !!}</span></span>
                            </div>

                        </li>
                        @endforeach
                        <li>
                            <div class="subtotal-text">Tổng cộng </div>
                            <div class="subtotal-price">{!! \Gloudemans\Shoppingcart\Facades\Cart::total() !!}đ</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>