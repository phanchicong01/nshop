<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 07-Dec-16
 * Time: 14:36
 */
?>
@extends('admin.master')
@section('title', 'Danh sách tài khoản quản trị website')
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
            <li class="active">Danh sách nhân viên</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Nhân Viên</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh đại diện</th>
                        <th>Email</th>
                        <th>Họ tên</th>
                        <th>Số điện thoại</th>
                        <th>Chức vụ</th>
                        <th width="20">Xem</th>
                        <th width="20">Sửa</th>
                        <th width="20">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;?>
                    @foreach($data as $item)
                    <tr>
                        <td>{!! ++$i !!}</td>
                        <td align="center" >
                            <img src="{!! $item["avatar"]!= '' ? asset('public/images/uploads/users/'.$item["avatar"]) : asset('public/images/icons/avatar2.png') !!}" width="80px" height="80px" class="img-responsive">
                        </td>
                        <td>{!! $item["email"] !!}</td>
                        <td>{!! $item["name"] !!}</td>
                        <td>{!! $item["phone"] !!}</td>
                        <td>
                            @if ($item["level"] == 1 && $item["id"] == 1)
                                <span style="color:red; font-weight: bold;">SuperAdmin</span>
                            @elseif ($item["level"] == 1)
                                <span style="color:blue; font-weight: bold;">Admin</span>
                            @elseif ($item["level"] == 2)
                                <span style="color:green; font-weight: bold;">Mod</span>
                            @endif
                        </td>
                        <td align="center"><a href="{!! route('getAdmin', ["id" => $item["id"]]) !!}" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        <td align="center"><a href="{!! route('getAdminEdit', ["id" => $item["id"]]) !!}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                        <td align="center"><a href="{!! route('getAdminDel', ["id" => $item["id"]]) !!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa nhân viên này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <!-- Datatables -->
    <link href="{!! asset("public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") !!}" rel="stylesheet">
    <link href="{!! asset("public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") !!}" rel="stylesheet">
@endsection
@section('javascript')
    <!-- Datatables -->
    <script src="{!! asset("public/vendors/datatables.net/js/jquery.dataTables.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js") !!}"></script>
    <script src="{!! asset("public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js") !!}"></script>

    <!-- Datatables -->
    <script>
        $(document).ready(function() {
            $('#datatable-responsive').DataTable();
        });
    </script>
    <!-- /Datatables -->
    <!-- My script -->
    <script src="{!! asset('public/js/myscript.js') !!}"></script>
    @if (Session::has('flash_level') && Session::get('flash_level') == 'result_msg')
        <script>
            $(document).ready(function () {
                swal("Thành Công!", "{!! Session::get('flash_messages') !!}", "success");
            });
        </script>
    @endif
    @if(Session::has('flash_level') && Session::get('flash_level') == 'error_msg')
        <script type="text/javascript">
            $(document).ready(function () {
                sweetAlert("Oops...", "{!! Session::get('flash_messages') !!}", "error");
            });
        </script>
    @endif
@endsection
