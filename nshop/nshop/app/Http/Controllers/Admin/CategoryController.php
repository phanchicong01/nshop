<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CateAddRequest;
use App\Http\Requests\CateEditRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use DateTime, Auth;
class CategoryController extends Controller
{
    public function getCateAdd () {
        $data = Category::select('id', 'name', 'id_parent')->get()->toArray();
        return view('admin.modules.category.category-add', ['data' => $data]);
    }
    public function postCateAdd (CateAddRequest $request) {
        $data             = new Category();
        $data->name      = $request->txtName;
        $data->alias      = str_slug($request->txtName, '-');
        $data->id_parent      = $request->txtParent;
        if($request->txtStatus != '')
            $data->status      = $request->txtStatus;
        else $data->status = 0;
        $data->created_at = new DateTime();
        $data->save();
        return redirect()->route('getCateList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Thêm danh mục thành công!']);
    }
    public function getCateList () {
        $data = Category::select('id', 'name', 'id_parent', 'status')->get()->toArray();
        return view('admin.modules.category.category-list', ['data' => $data]);
    }
    public function getCateDel ($id) {
        $id_parent = Category::where('id_parent', $id)->count();
        if ($id_parent == 0) {
            $data = Category::find($id);
            $data->delete($id);
            return redirect()->route('getCateList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa danh mục thành công!']);
        } else {
            return redirect()->back()->with(['flash_level' => 'error_msg', 'flash_messages' => 'Bạn không được xóa danh mục này, vì có danh mục khác thuộc danh mục này!']);
        }
    }
    public function getCateEdit ($id) {
        $data = Category::findOrFail($id)->toArray();
        $data_cate = Category::select('id', 'name', 'id_parent')->get()->toArray();
        return view('admin.modules.category.category-edit', ['data' => $data, 'data_cate' => $data_cate]);
    }
    public function postCateEdit (CateEditRequest $request, $id) {
        $data= Category::find($id);
        $data->name      = $request->txtName;//lấy từ form qua
        $data->alias      = str_slug($request->txtName, '-');
        $data->id_parent      = $request->txtParent;
        if($request->txtStatus != '')
            $data->status      = $request->txtStatus;
        else $data->status = 0;
        $data->updated_at = new DateTime();
        $data->save();
        return redirect()->route('getCateList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Sửa danh mục thành công!']);
    }
}