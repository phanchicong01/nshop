<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 17:22
 */
?>
<div class="footer-top-area" style="margin-top: 20px">
    <div class="container">
        <div class="row">
            <!-- footer-widget start -->
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="footer-widget">
                    <img src="{!! asset("public/images/logo/logo.png") !!}" alt="" />
                    <p>
                        "Chúng tôi khác biệt...!" - Sau khi thành lập đến nay Nshop đã ngày càng phát triển và hoàn thiện hơn, và đáp ứng nhu cầu mua sắm của các bạn trẻ.
                        <br>
                        <br>
                        Nshop đã mang đến đầy đủ mọi mặt hàng gồm quần áo, giày dép và các phụ kiện thời trang, đồ chơi kĩ thuật số có chất lượng cao và giá thành rẻ cho các bạn trẻ Việt Nam..
                    </p>
                    <div class="widget-icon">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                    </div>
                </div>
            </div>
            <!-- footer-widget end -->
            <!-- footer-widget start -->
            <div class="col-lg-3 col-md-3 hidden-sm">
                <div class="footer-widget">
                    <h3>Điều khoản & chính sách</h3>
                    <ul class="footer-menu">
                        <li><a href="{!! route('getDKDV') !!}">Điều khoản dịch vụ</a></li>
                        <li><a href="{!! route('getDKMH') !!}">Điều khoản mua hàng</a></li>
                        <li><a href="{!! route('getDKTT') !!}">Điều khoản thanh toán</a></li>
                        <li><a href="{!! route('getDKVC') !!}">Điều khoản vận chuyển</a></li>
                        <li><a href="{!! route('getCSBM') !!}">Chính sách bảo mật</a></li>
                        <li><a href="{!! route('getCSVC') !!}">Chính sách vận chuyển</a></li>
                        <li><a href="{!! route('getCSDT') !!}">Chính sách đổi trả</a></li>
                        <li><a href="{!! route('getCSMH') !!}">Chính sách mua hàng</a></li>
                    </ul>
                </div>
            </div>
            <!-- footer-widget end -->
            <!-- footer-widget start -->
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="footer-widget">
                    <h3>hướng dẫn</h3>
                    <ul class="footer-menu">
                        <li><a href="{!! route('getHDMH') !!}">Hướng dẫn mua hàng</a></li>
                        <li><a href="{!! route('getHDTT') !!}">Hướng dẫn thanh toán</a></li>
                        <li><a href="{!! route('getHDGN') !!}">Hướng dẫn giao nhận</a></li>
                        <li><a href="{!! route('getHDDT') !!}">Hướng dẫn đổi trả</a></li>
                    </ul>
                </div>
            </div>
            <!-- footer-widget end -->
            <!-- footer-widget start -->
            <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="footer-widget">
                    <h3>Liên hệ</h3>
                    <ul class="footer-contact">
                        <li><i class="fa fa-map-marker"></i> 123 Cung Vàng, Điện Ngọc, Thành Phố Trăng</li>
                        <li><i class="fa fa-envelope"></i>	Email: administrator@gmail.com</li>
                        <li><i class="fa fa-phone"></i> Phone: 01278391639</li>
                    </ul>
                    <div>
                        <h3>Thống kê</h3>
                        <span style="color: #d5d5d5">Đang online:
                            <?php
                            use Kim\Activity\Activity;
                            Activity::guests(1)->get();
                            $count_online = Activity::guests()->count();
                            if($count_online == 0)
                                $count_online = $count_online + 1;
                            echo $count_online;
                            ?>
                            <br>
                            Số lượng truy cập: <?php $data = countVisit();
                            echo $data->count;?>
                        </span>
                    </div>

                </div>
            </div>
            <!-- footer-widget end -->
        </div>
    </div>
</div>
