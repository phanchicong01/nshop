<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 07-Dec-16
 * Time: 13:29
 */
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{!! url('/nshop-admin') !!}" class="site_title"><i class="fa fa-paw"></i> <span>Nshop Admin!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{!! Auth::guard("admin")->user()->avatar != '' ? asset('public/images/uploads/users/'.Auth::guard("admin")->user()->avatar) : asset('public/images/icons/avatar2.png') !!}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Xin chào,</span>
                <h2>{!! Auth::guard("admin")->user()->name !!}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu Quản Lý</h3>
                <ul class="nav side-menu">
                    <li><a href="{!! url('/nshop-admin') !!}"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                    @if(Auth::guard('admin')->user()->level == 1)
                    <li><a><i class="fa fa-user-circle" aria-hidden="true"></i> Quản Lý User <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! route('getAdminAdd') !!}"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm Nhân Viên</a></li>
                            <li><a href="{!! route('getAdminList') !!}"><i class="fa fa-user-secret" aria-hidden="true"></i> Danh Sách Nhân Viên</a></li>
                            <li><a href="{!! route('getGuestList') !!}"><i class="fa fa-users" aria-hidden="true"></i> Danh Sách Khách Hàng</a></li>
                        </ul>
                    </li>
                    @endif
                    <li><a><i class="fa fa-align-justify" aria-hidden="true"></i> Quản Lý Danh Mục <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! route('getCateAdd') !!}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Danh Mục Mới</a></li>
                            <li><a href="{!! route('getCateList') !!}"><i class="fa fa-list-ul" aria-hidden="true"></i> Danh Sách Danh Mục</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cube" aria-hidden="true"></i> Quản Lý Sản Phẩm <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! route('getProductAdd') !!}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Sản Phẩm Mới</a></li>
                            <li><a href="{!! route('getProductList') !!}"><i class="fa fa-cubes" aria-hidden="true"></i> Danh Sách Sản Phẩm</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-newspaper-o" aria-hidden="true"></i> Quản Lý Tin Tức <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! route('getNewsAdd') !!}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Tin Mới</a></li>
                            <li><a href="{!! route('getNewsList') !!}"><i class="fa fa-list-ul" aria-hidden="true"></i> Danh Sách Tin</a></li>
                        </ul>
                    </li>
                    <li><a href="{!! route('getOrderList') !!}"><i class="fa fa-shopping-bag"></i> Quản Lý Đơn Hàng</a></li>
                    <li><a href="{!! route('getCommentList') !!}"><i class="fa fa-comments" aria-hidden="true"></i> Quản Lý Bình Luận</a></li>
                    <li><a href="{!! route('getSliderList') !!}"><i class="fa fa-sliders"></i> Quản Lý Slider </a></li>
                    <li><a><i class="fa fa-envelope" aria-hidden="true"></i> Quản Lý Email Đăng Ký<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! route('getSubscribeList') !!}"><i class="fa fa-list-ul" aria-hidden="true"></i> Danh Sách Email</a></li>
                            <li><a href="{!! route('getSendMail') !!}"><i class="fa fa-share" aria-hidden="true"></i> Gửi Mail</a></li>
                        </ul>
                    </li>
                    @if(Auth::guard('admin')->user()->level == 1)
                    <li><a><i class="fa fa-desktop" aria-hidden="true"></i> Quản Lý Trang<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! route('getInfoPageEdit') !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Từ Khóa, Mô Tả Trang</a></li>
                            <li><a href="{!! route('getProvisionEdit') !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Trang Điều Khoản</a></li>
                            <li><a href="{!! route('getPolicyEdit') !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Trang Chính Sách</a></li>
                            <li><a href="{!! route('getGuideEdit') !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Trang Hướng Dẫn</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
