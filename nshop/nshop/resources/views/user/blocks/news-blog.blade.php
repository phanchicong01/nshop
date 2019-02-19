<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 17:18
 */
?>
<div class="latest-blog-area pad-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>Tin tức thời trang</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="latest-blog-curosel">
                @foreach($data_news as $item)
                <!-- single-latest-blog start -->
                <div class="col-lg-12">
                    <div class="single-latest-blog">
                        <div class="latest-blog-img">
                            <a href="{!! route('getNewsDetail', ['id' => $item['id'], 'slug' => $item['alias']]) !!}"><img src="{!! asset('public/images/uploads/news/'.$item['image']) !!}" alt="{!! $item['name'] !!}" /></a>
                        </div>
                        <div class="latest-blog-content">
                            <h3><a href="{!! route('getNewsDetail', ['id' => $item['id'], 'slug' => $item['alias']]) !!}">{!! $item['name'] !!}</a></h3>
                            <div class="meta">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    <?php \Carbon\Carbon::setLocale('vi') ?>
                                    {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}
                                </span>
                            </div>
                            <p>{!! cutString($item['intro'], 150) !!}</p>
                        </div>
                    </div>
                </div>
                <!-- single-latest-blog end -->
                @endforeach
            </div>
        </div>
    </div>
</div>
