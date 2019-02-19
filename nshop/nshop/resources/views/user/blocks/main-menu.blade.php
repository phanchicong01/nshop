


<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:44
 */
?>
<?php
$data = \App\Models\Category::select('id', 'name', 'alias', 'id_parent')->where('status', 1)->get()->toArray();
?>
<div class="main-menu-area bg-color hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="main-menu">
                    <nav>
                        <ul>
                            <li><a href="{!! route('index') !!}">Trang chủ</a> 
                            {{--<ul>--}}
                                                {{--<li><a href="about.html">about us</a></li>--}}
                                                {{--<li><a href="cart.html">shopping cart</a></li>--}}
                                                {{--<li><a href="checkout.html">checkout</a></li>--}}
                                                {{--<li><a href="wishlist.html">wishlist</a></li>--}}
                                                {{--<li><a href="login.html">login</a></li>--}}
                                                {{--<li><a href="shop.html">shop</a></li>--}}
                                                {{--<li><a href="shop-list.html">shop list</a></li>--}}
                                                {{--<li><a href="single-product.html">single-product</a></li>--}}
                                                {{--<li><a href="blog.html">blog</a></li>--}}
                                                {{--<li><a href="single-blog.html">single-blog</a></li>--}}
                                                {{--<li><a href="single-blog-video.html">single-blog-video</a></li>--}}
                                                {{--<li><a href="contact.html">contact us</a></li>--}}
                            {{--</ul>--}}
                            </li>
                            @foreach($data as $item)
                                @if($item['id_parent'] == 0)
                                    <li><a href="#">{!! $item['name'] !!}</a>
                                        <div class="mega-menu">
                                            @foreach($data as $item_child1)
                                                <span>
                                                    @if($item_child1['id_parent'] == $item['id'])
                                                        <a class="mega-title" href="{!! route('getCategory', ['id' => $item_child1['id'], 'slug' => $item_child1['alias']]) !!}">{!! $item_child1['name'] !!}
                                                            @foreach($data as $item_child2)
                                                                @if($item_child2['id_parent'] == $item_child1['id'])
                                                                    <a href="{!! route('getCategory', ['id' => $item_child2['id'], 'slug' => $item_child2['alias']]) !!}">{!! $item_child2['name'] !!}</a>
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                    @endif
                                                </span>
                                            @endforeach
                                         </div>
                                    </li>
                                @endif
                            @endforeach
                            <li><a href="{!! route('getNews') !!}">Tin tức </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
