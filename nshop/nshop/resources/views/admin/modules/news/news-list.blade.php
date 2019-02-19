<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 10-Dec-16
 * Time: 18:15
 */
?>
@extends('admin.master')
@section('title', 'Danh sách tin tức')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý tin tức</a></li>
                <li class="active">Danh sách tin tức</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh Sách Tin Tức</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề tin</th>
                            <th>Hình</th>
                            <th>Tóm tắt</th>
                            <th width="40">Trạng thái</th>
                            <th>Người đăng</th>
                            <th width="20">Xem</th>
                            <th width="20">Sửa</th>
                            @if(Auth::guard('admin')->user()->level == 1)
                            <th width="20">Xóa</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach($data as $item)
                            <tr>
                                <td>{!! ++$i !!}</td>
                                <td>{!! $item["name"] !!}</td>
                                <td>
                                    <img src="{!! $item['image'] != '' ? asset('public/images/uploads/news/'.$item['image']) : asset('public/images/icons/no-photo.png') !!}" width="80px" height="80px" class="img-responsive">
                                </td>
                                <td>{!! $item["intro"] !!}</td>
                                <td>
                                    @if ($item["status"] == 0)
                                        <span style="color:red; font-weight: bold;">Ẩn</span>
                                    @else
                                        <span style="color:blue; font-weight: bold;">Hiện</span>
                                    @endif
                                </td>
                                <td>{!! $item["user"]["name"] !!}</td>
                                <td align="center"><a href="{!! route('getNewsDetail', ['id' => $item['id'], 'slug' => $item['alias']]) !!}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
                                <td align="center"><a href="{!! route('getNewsEdit', ["id" => $item["id"]]) !!}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                                @if(Auth::guard('admin')->user()->level == 1)
                                <td align="center"><a href="{!! route('getNewsDel', ["id" => $item["id"]]) !!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa bài viết này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
                                @endif
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