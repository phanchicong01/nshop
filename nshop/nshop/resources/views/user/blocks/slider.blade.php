<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:48
 */
?>
<div class="container-fluid" style="margin-top: 20px ;">
    <div class="slider-wrap">
        <div class="fullwidthbanner-container" style="max-height: 400px !important;" >
        <div class="fullwidthbanner" style="max-height: 400px !important;">
            <ul style="max-height: 400px !important;">
                @foreach($data_slider as $item)
                <li style="max-height: 400px !important;" data-transition="fade" data-slotamount="3" data-masterspeed="300" data-saveperformance="on">
                    <!--MAIN IMAGE-->
                    <a href="{!! $item['link'] !!}">
                        <img src="{!! asset('public/images/uploads/sliders/'.$item['image']) !!}" alt="" data-bgposition="center top" data-duration="" data-ease="Power0.easeInOut" data-bgfit="cover" data-bgrepeat="no-repeat" width="100%" />
                    </a>
                    <!-- LAYER NR. -->
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
</div>