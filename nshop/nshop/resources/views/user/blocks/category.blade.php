    <?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 17:01
 */
?>
<div class="category-area pad-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="section-title">
                    <h2>Sản phẩm bán chạy</h2>
                </div>
                <div class="category-curosel">
                    <?php
                        $id_product_array = \App\Models\OrderDetail::select(DB::raw('count(*) as count_id, id_product'))->groupBy('id_product')->orderBy('count_id', 'DESC')->limit(6)->get()->toArray();
                    ?>
                        @for($index = 1; $index <= 3; $index++)
                            <?php
                            $nop = 2;
                            $offset = ($index - 1) * $nop;
                            $data_promotion = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion')/*->whereIn('id',$id_product_array)*/->where('status', 1)->orderBy('count_sell', 'DESC')->offset($offset)->limit($nop)->get()->toArray();
                            ?>
                            <div class="category-item">
                            @foreach($data_promotion as $item)
                                <!-- single-product start -->
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                                <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                                @foreach($data_images as $item_images)
                                                    @if($i == 0)
                                                        <img class="primary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}" />
                                                        <?php $i++;?>
                                                    @else
                                                        <img class="secondary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}-1" />
                                                    @endif
                                                @endforeach
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                                            <div class="pro-price">
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
                                            <div class="product-action">
                                                <div class="pro-button-top">
                                                    <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">Xem</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product end -->
                                @endforeach
                            </div>
                        @endfor
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="section-title">
                    <h2>Sản phẩm giảm giá</h2>
                </div>
                <div class="category-curosel">
                    @for($index = 1; $index <= 3; $index++)
                    <?php
                        $nop = 2;
                        $offset = ($index - 1) * $nop;
                        $data_promotion = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion')->where('promotion', '<>', '')->where('status', 1)->orderBy('updated_at', 'DESC')->offset($offset)->limit($nop)->get()->toArray();
                    ?>
                        <div class="category-item">
                        @foreach($data_promotion as $item)
                            <!-- single-product start -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                        <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                        @foreach($data_images as $item_images)
                                            @if($i == 0)
                                                <img class="primary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}" />
                                                <?php $i++;?>
                                            @else
                                                <img class="secondary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}-1" />
                                            @endif
                                        @endforeach
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h3><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                                    <div class="pro-price">
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
                                    <div class="product-action">
                                        <div class="pro-button-top">
                                            <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">Xem</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single-product end -->
                        @endforeach
                        </div>
                   @endfor
                </div>
            </div>
            <div class="col-lg-4 col-md-4 hidden-sm">
                <div class="section-title">
                    <h2>Sản phẩm xem nhiều</h2>
                </div>
                <div class="category-curosel">
                    @for($index = 1; $index <= 3; $index++)
                        <?php
                        $nop = 2;
                        $offset = ($index - 1) * $nop;
                        $data_promotion = \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion', 'view')->where('status', 1)->orderBy('view', 'DESC')->offset($offset)->limit($nop)->get()->toArray();
                        ?>
                        <div class="category-item">
                        @foreach($data_promotion as $item)
                            <!-- single-product start -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">
                                            <?php $data_images =  getImageProductFront($item['id']); $i = 0; ?>
                                            @foreach($data_images as $item_images)
                                                @if($i == 0)
                                                    <img class="primary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}" />
                                                    <?php $i++;?>
                                                @else
                                                    <img class="secondary-img" src="{!! asset('public/images/uploads/products/'.$item_images['image']) !!}" alt="{!! $item['name'] !!}-1" />
                                                @endif
                                            @endforeach
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h3><a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                                        <div class="pro-price">
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
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="{!! route('getProduct', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">Xem</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product end -->
                            @endforeach
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
