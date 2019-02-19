<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:50
 */
?>
<div class="features-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product-curosel">
                @foreach($data_features as $item)
                <!-- single-product start -->
                <div class="col-lg-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                @foreach($data_images as $item_images)
                                    @if($i == 0)
                                        <img class="primary-image" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}" />
                                        <?php $i++;?>
                                    @else
                                        <img class="secondary-image" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}-1" />
                                    @endif
                                @endforeach
                            </a>
                            @if($item['promotion'] != '')
                            <span class="sale">sale</span>
                            @endif
                            <div class="product-action">
                                <div class="pro-button-top">
                                    <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                    <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                            <div class="pro-price text-center">
                                <span class="normal">
                                    @if($item['promotion'] != '')
                                        {!! number_format($item['promotion'], 0, ',', '.') !!}<sup>đ</sup>
                                    @else
                                        {!! number_format($item['price'], 0, ',', '.') !!}<sup>đ</sup>
                                    @endif
                                </span>
                                @if($item['promotion'] != '')
                                    <span class="old">{!! number_format($item['price'], 0, ',', '.') !!}<sup>đ</sup></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single-product end -->
                @endforeach
            </div>
        </div>
    </div>
</div>
