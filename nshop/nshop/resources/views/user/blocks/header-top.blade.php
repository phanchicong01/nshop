<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 11-Dec-16
 * Time: 16:24
 */
?>
<div class="header-top-area bg-color hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="welcome">
                    <span class="phone">Phone: 01278391639</span> <span class="hidden-sm">/</span>
                    <span class="email hidden-sm">Email: phanchicong01@gmail.com</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="top-menu">
                    <ul>
                        @if(!Auth::guard('user')->check())
                        <li><a href="{!! url('login') !!}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Đăng nhập</a></li>
                        <li><a href="{!! url('register') !!}"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng ký</a></li>
                        @else
                            <ul id="language">
                                <li><a href="#">Xin chào {!! Auth::guard('user')->user()->name !!} <i class="fa fa-angle-down"></i></a>
                                    <ul>
                                        <li><a href="{!! route('getCustomerProfile', ['id' => \Illuminate\Support\Facades\Auth::guard('user')->user()->id]) !!}">Thông tin tài khoản</a></li>
                                        <li>
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out pull-right" style=""></i> Đăng xuất </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
