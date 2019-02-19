<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 16-Dec-16
 * Time: 02:11
 */
?>
@extends('admin.master')
@section('title', 'Danh sách tài khoản khách hàng')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý user</a></li>
                <li class="active">Danh sách khách hàng</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thông Tin Khách Hàng</h2>
                    <div class="clearfix"></div>
                </div>
            </div>
                <div class="x_content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Panel title</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Ho Ten</th>
                                    <th>SDT</th>
                                    <th>Dia Chi</th>
                                    <th>Gioi Tinh</th>
                                    <th>Ngay Sinh</th>
                                    <th>Avatar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{!!  $data["email"]  !!}</td>
                                    <td>{!!  $data["name"]  !!}</td>
                                    <td>{!!  $data["phone"]  !!}</td>
                                    <td>{!!  $data["address"]  !!}</td>
                                    <td>{!!  $data["gender"]  !!}</td>
                                    <td>{!!  $data["birthday"]  !!}</td>
                                    <td>
                                        <img src="{!! $data["avatar"]!= '' ? asset('public/images/uploads/users/'.$data["avatar"]) : asset('public/images/icons/avatar2.png') !!}" class="img-responsive" id="img-current" width="40px" height="40px" alt="">
                                        <input type="hidden" name="txtAvatar_Current" value="{!! $data["avatar"] !!}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
