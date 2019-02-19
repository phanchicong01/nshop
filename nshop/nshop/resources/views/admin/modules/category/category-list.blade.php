<?php
/**
 * Created by Chí Công
 * User: phanchicong01@gmail.com
 * Date: 09-Dec-16
 * Time: 07:42
 */
?>
@extends('admin.master')
@section('title', 'Danh sách danh mục')
@section('keywords', '')
@section('description', '')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="{!! route('getDashboard') !!}">Dashboard</a>
                </li>
                <li><a href="#">Quản lý danh mục</a></li>
                <li class="active">Danh sách danh mục</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh Sách Danh Mục</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Danh mục cha</th>
                            <th width="40">Trạng thái</th>
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
                                    @if ($item["id_parent"] == 0)
                                        Không có
                                    @else
                                        <?php
                                        $parent = DB::table('categories')->select('name')->where('id', $item["id_parent"])->first();
                                        echo $parent->name;
                                        ?>
                                    @endif
                                </td>
                                <td>
                                    @if ($item["status"] == 0)
                                        <span style="color:red; font-weight: bold;">Ẩn</span>
                                    @else
                                        <span style="color:blue; font-weight: bold;">Hiện</span>
                                    @endif
                                </td>
                                <td align="center"><a href="{!! route('getCateEdit', ["id" => $item["id"]]) !!}" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                                @if(Auth::guard('admin')->user()->level == 1)
                                <td align="center"><a href="{!! route('getCateDel', ["id" => $item["id"]]) !!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa danh mục này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
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
