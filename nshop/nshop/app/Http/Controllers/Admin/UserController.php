<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use DateTime, Auth, File;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
//    Admin
    public function getAdminAdd () {
        return view('admin.modules.user.admin-add');
    }
    public function postAdminAdd (AdminAddRequest $request) {
        $data = new Admin();
        $data->email = $request->txtEmail;
        $data->password = bcrypt($request->txtPassword);
        $data->name = $request->txtName;
        $data->phone = $request->txtPhone;
        $data->address = $request->txtAddress;
        $file  = $request->file('txtAvatar');
        if (strlen($file) > 0) {
            $filename        = time()."-".$file->getClientOriginalName();
            $destinationPath = 'images/uploads/users/';
            $file->move($destinationPath,$filename);
            $data->avatar   = $filename;
        }
        $data->gender = $request->txtGender;
        $data->birthday =date("Y-m-d", strtotime(str_replace('/', '-', $request->txtBirthday)));
        $data->level = $request->txtLevel;
        $data->created_at = new DateTime();
        $data->save();
        return redirect()->route('getAdminList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Thêm nhân viên mới thành công!']);
    }
    public function getAdminList () {
        $data = Admin::select('id', 'email', 'name', 'phone', 'avatar', 'level', 'gender', 'birthday')->get()->toArray();
        return view('admin.modules.user.admin-list', ['data' => $data]);
    }
    public function getAdminDel ($id) {
        $user_current_login = Auth::guard('admin')->user()->id;
        $user_delete = Admin::find($id);
        if (($id == 1) || ($user_current_login != 1 && $user_delete["level"] == 1)) {
            return redirect()->route('getAdminList')->with(['flash_level' => 'error_msg', 'flash_messages' => 'Bạn không được phép xóa nhân viên này!']);
        } else {
            $user_delete->delete($id);
            return redirect()->route('getAdminList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa nhân viên thành công']);
        }
    }
    public function getAdminEdit ($id) {
        $data = Admin::findOrFail($id)->toArray();
        if ((Auth::guard('admin')->user()->id != 1) && ($id == 1 || ($data["level"] == 1 && (Auth::guard('admin')->user()->id != $id)))) {
            return redirect()->route('getAdminList')->with(['flash_level' => 'error_msg', 'flash_messages' => 'Bạn không có quyền sửa nhân viên này']);
        }
        return view('admin.modules.user.admin-edit', ['data' => $data]);
    }
    public function getAdmin ($id) {
        $data = Admin::findOrFail($id)->toArray();
        if ((Auth::guard('admin')->user()->id != 1) && ($id == 1 || ($data["level"] == 1 && (Auth::guard('admin')->user()->id != $id)))) {
            return redirect()->route('getAdminList')->with(['flash_level' => 'error_msg', 'flash_messages' => 'Bạn không có quyền xem nhân viên này']);
        }
        return view('admin.modules.user.admin-view', ['data' => $data]);
    }
    public function postAdminEdit (AdminEditRequest $request, $id) {
        $data = Admin::find($id);

        if (Auth::guard('admin')->user()->id != $id) {//nếu không phải là user đăng nhập
            if (isset($request->txtLevel))
                $data->level = $request->txtLevel;
            $data->updated_at = new DateTime;
            $data->save();
            return redirect()->route('getAdminList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thông tin nhân viên thành công!']);
        }
        else {
            if (Hash::check($request->txtPassword,Auth::guard('admin')->user()->password)) {
                if ($request->txtPasswordNew != '')
                    $data->password = bcrypt($request->txtPasswordNew);
                $data->name = $request->txtName;
                $data->phone = $request->txtPhone;
                $data->address = $request->txtAddress;
                $file  = $request->file('txtAvatar');
                if (strlen($file) > 0) {
                    $image_current = $request->txtAvatar_Current;
                    if (file_exists(public_path().'/images/uploads/users/'.$image_current)) {
                        File::delete(public_path().'/images/uploads/users/'.$image_current);//nếu có file upload thì xóa hình cũ đi
                    }
                    $filename        = time()."-".$file->getClientOriginalName();
                    $destinationPath = 'images/uploads/users/';
                    $file->move($destinationPath,$filename);
                    $data->avatar   = $filename;
                }
                $data->name = $request->txtName;
                $data->gender = $request->txtGender;
                $data->birthday = date("Y-m-d", strtotime(str_replace('/', '-', $request->txtBirthday)));
                $data->updated_at = new DateTime;
                $data->save();
                return redirect()->route('getAdminList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thông tin nhân viên thành công!']);
            }
            else {
                return redirect()->back()->with(['flash_level' => 'error_msg', 'flash_messages' => 'Mật khẩu hiện tại của bạn không chính xác!']);
            }
        }
    }
//    Guest
    public function getGuestList () {
        $data = User::select('id', 'email', 'name', 'phone', 'avatar', 'gender', 'birthday')->get()->toArray();
        return view('admin.modules.user.guest-list', ['data' => $data]);
    }
    public function getGuestDel ($id) {
        $data = User::find($id)->delete();
        return redirect()->route('getGuestList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa khách hàng thành công']);
    }
    public function getUserDetail($id) {
        $data = User::findOrFail($id)->toArray();
        return view('admin.modules.user.user-detail' , ['data' => $data]);
    }
}
