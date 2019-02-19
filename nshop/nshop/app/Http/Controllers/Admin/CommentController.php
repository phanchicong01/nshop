<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
class CommentController extends Controller
{
    public function getCommentList () {
        $data = Comment::with('product')->with('user')->select('id', 'id_product', 'content', 'id_user', 'created_at')->orderBy('created_at', 'DESC')->get()->toArray();
        return view('admin.modules.comment.comment-list', ['data' => $data]);
    }
    public function getCommentDel ($id) {
        Comment::where('id', $id)->delete();
        return redirect()->route('getCommentList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa bình luận thành công']);
    }
}
