<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 21-Dec-16
 * Time: 10:24
 */
?>

@extends('admin.master')
@section('title', 'Danh sách bình luận')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý bình luận</a></li>
                <li class="active">Danh sách bình luận</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh Sách Bình Luận</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Nội dung bình luận</th>
                            <th>Người bình luận</th>
                            <th>Thời gian</th>
                            <th width="20">Xem</th>
                            <th width="20">Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $num = 0;?>
                        @foreach($data as $item)
                            <tr>
                                <td>{!! ++$num !!}</td>
                                <td><a href="{!! route('getProduct', ['id' => $item['product']['id'], 'slug' => $item['product']['alias']]) !!}" target="_blank">{!! $item['product']["name"] !!}</a></td>
                                <td>{!! $item["content"] !!}</td>
                                <td>{!! $item['user']["name"] !!}</td>
                                <td>
                                    <?php \Carbon\Carbon::setLocale('vi') ?>
                                    {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item["created_at"]))->diffForHumans() !!}
                                </td>
                                <td align="center"><a href="{!! route('getProduct', ['id' => $item['product']['id'], 'slug' => $item['product']['alias']]) !!}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
                                <td align="center"><a href="{!! route('getCommentDel', ["id" => $item["id"]]) !!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa bình luận này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
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