<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:56
 */
?>
<div class="new-product-area pad-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>Sản phẩm mới</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product-tab">
                    <!-- Nav tabs -->
                    <ul class="tab-menu" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Áo quần nam</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Áo quần nữ</a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Phụ kiện nam</a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Phụ kiện nữ</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="product-curosel">
                                    <?php
                                            $cate = \App\Models\Category::select('id')->whereIn('id_parent', [2, 6])->where('status', 1)->get()->toArray();
                                            $data = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion', 'id_cate')->whereIn('id_cate', $cate)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(8)->get()->toArray();
                                    ?>
                                    @foreach($data as $item)
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
                                                            <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
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
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="row">
                                <div class="product-curosel">
                                <?php
                                    $cate = \App\Models\Category::select('id')->whereIn('id_parent', [12, 17, 20])->where('status', 1)->get()->toArray();
                                    $data = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion', 'id_cate')->whereIn('id_cate', $cate)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(8)->get()->toArray();
                                ?>
                                @foreach($data as $item)
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
                                                        <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
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
                        <div role="tabpanel" class="tab-pane" id="messages">
                            <div class="row">
                                <div class="product-curosel">
                                <?php
                                    $cate = \App\Models\Category::select('id')->where('id_parent', 24)->where('status', 1)->get()->toArray();
                                    $data = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion', 'id_cate')->whereIn('id_cate', $cate)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(8)->get()->toArray();
                                ?>
                                @foreach($data as $item)
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
                                                        <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
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
                        <div role="tabpanel" class="tab-pane" id="settings">
                            <div class="row">
                                <div class="product-curosel">
                                <?php
                                $cate = \App\Models\Category::select('id')->where('id_parent', 28)->where('status', 1)->get()->toArray();
                                $data = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion', 'id_cate')->whereIn('id_cate', $cate)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(8)->get()->toArray();
                                ?>
                                @foreach($data as $item)
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
                                                            <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
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
                </div>
            </div>
        </div>
    </div>
</div>
