<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\User;
use Mail;
class SubscribeController extends Controller
{
    public function getSubscribeList() {
        $data = Subscribe::select('id', 'email', 'created_at')->orderBy('created_at', 'DESC')->get()->toArray();
        return view('admin.modules.subscribe.subscribe-list', ['data' => $data]);
    }
    public function getSubscribeDel ($id) {
        Subscribe::find($id)->delete();
        return redirect()->route('getSubscribeList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa email thành công!']);
    }
    public function getSendMail() {
        return view('admin.modules.subscribe.send-mail');
    }
    public function postSendMail(Request $request) {
        if($request->txtGroup == 1) {
            $data_email_arr = Subscribe::select('email')->get()->toArray();
            foreach ($data_email_arr as $item) {
                $email = $item['email'];
                $name = $item['email'];
                $title = $request->txtName;
                $data = ['name' => $email, 'content' => $request->txtContent];
                Mail::send('admin.mail.mail-subscribe', $data, function ($message) use ($email, $name, $title) {
                    $message->from('phanchicong01@gmail.com', 'nshop.dev');
                    $message->to($email, $name);
                    $message->subject($title);
                });
            }
            return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Gửi Thành Công!']);
        }
        else if($request->txtGroup == 2) {
            $data_email_arr = User::select('email', 'name')->get()->toArray();
            foreach ($data_email_arr as $item) {
                $email =$item['email'];
                $name = $item['name'];
                $title = $request->txtName;
                $data = ['name' => $email, 'content' => $request->txtContent];
                Mail::send('admin.mail.mail-subscribe', $data, function ($message) use ($email, $name, $title) {
                    $message->from('phanchicong01@gmail.com', 'nshop.dev');
                    $message->to($email, $name);
                    $message->subject($title);
                });
            }
            return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Gửi Thành Công!']);
        }
        return redirect()->back()->with(['flash_level' => 'error_msg', 'flash_messages' => 'Gửi Thất Bại!']);
    }
}
