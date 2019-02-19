<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 07-Dec-16
 * Time: 13:37
 */
?>
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{!! Auth::guard("admin")->user()->avatar != '' ? asset('public/images/uploads/users/'.Auth::guard("admin")->user()->avatar) : asset('public/images/icons/avatar2.png') !!}">
                         {!! Auth::guard("admin")->user()->name !!}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{!! route('getAdminEdit', ["id" => \Illuminate\Support\Facades\Auth::guard('admin')->user()->id]) !!}"> Thông tin cá nhân</a></li>
                        <li><a href="{{ url('/nshop-logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a>
                            <form id="logout-form" action="{{ url('/nshop-logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="{!! route('index') !!}" >
                        <i class="fa fa-home"></i>
                      Xem Trang Chủ
                    </a>

                </li>
            </ul>
        </nav>
    </div>
</div>
