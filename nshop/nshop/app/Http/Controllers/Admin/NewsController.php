<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\NewsAddRequest;
use App\Http\Requests\NewsEditRequest;
use App\Http\Controllers\Controller;
use App\Models\News;
use Auth, File, DateTime;

class NewsController extends Controller
{
    public function getNewsAdd () {
        return view('admin.modules.news.news-add');
    }
    public function postNewsAdd (NewsAddRequest $request) {
        $data             = new News();
        $data->name    = $request->txtName;
        $data->intro  = $request->txtIntro;
        $data->content  = $request->txtContent;
        $data->alias      = str_slug($request->txtName, '-');
        if ($request->hasFile('txtImage')) {
            $file = $request->file('txtImage');
            $filename = time() . "-" . $file->getClientOriginalName();
            $destinationPath = 'images/uploads/news/';
            $file->move($destinationPath, $filename);
            $data->image = $filename;
        }
        $data->keyword     = $request->txtKeyword;
        $data->description     = $request->txtDescription;
        if($request->txtStatus != '')
            $data->status = $request->txtStatus;
        else $data->status = 0;
        $data->id_user     = Auth::guard('admin')->user()->id;
        $data->created_at = new DateTime();
        $data->save();
        return redirect()->route('getNewsList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Thêm bài viết thành công!']);
    }
    public function getNewsList () {
        $data = News::with('user')->select('id', 'name', 'intro', 'image','status', 'alias', 'id_user', 'updated_at')->orderBy('updated_at', 'DESC')->get()->toArray();
        return view('admin.modules.news.news-list', ['data' => $data]);
    }
    public function getNewsDel ($id) {
        News::find($id)->delete();
        return redirect()->route('getNewsList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa bài viết thành công!']);
    }
    public function getNewsEdit ($id) {
        $data = News::where('id', $id)->firstOrFail();
        return view('admin.modules.news.news-edit', ["data" => $data]);
    }
    public function postNewsEdit (NewsEditRequest $request, $id) {
        $data = News::find($id);
//        $data_image = $data->get();
        $data->name    = $request->txtName;
        $data->intro  = $request->txtIntro;
        $data->content  = $request->txtContent;
        $data->alias      = str_slug($request->txtName, '-');
        if ($request->hasFile('txtImage')) {
            if (file_exists(public_path().'/images/uploads/news/'.$data->image)) {
                File::delete(public_path().'/images/uploads/news/'.$data->image);
            }
            $file = $request->file('txtImage');
            $filename = time() . "-" . $file->getClientOriginalName();
            $destinationPath = 'images/uploads/news/';
            $file->move($destinationPath, $filename);
            $data->image = $filename;
        }
        $data->keyword     = $request->txtKeyword;
        $data->description     = $request->txtDescription;
        if($request->txtStatus != '')
            $data->status = $request->txtStatus;
        else $data->status = 0;
        $data->id_user     = Auth::guard('admin')->user()->id;
        $data->updated_at = new DateTime();
        $data->save();
        return redirect()->route('getNewsList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Sửa bài viết thành công!']);
    }
}
