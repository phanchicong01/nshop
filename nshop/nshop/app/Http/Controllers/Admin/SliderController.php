<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderEditRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Auth, File, DateTime;

class SliderController extends Controller
{
    public function getSliderList () {
        $data = Slider::with('user')->select('id', 'image', 'link', 'created_at', 'id_user', 'status')->get()->toArray();
        return view('admin.modules.slider.slider-list', ["data" => $data]);
    }
    public function postSliderAdd (SliderAddRequest $request) {
        if ($request->hasFile('txtImage')) {
            $files = $request->file('txtImage');
            foreach($files as $file) {
                $data             = new Slider();
                $data->id_user     = Auth::guard('admin')->user()->id;
                $data->status     = $request->txtStatus;
                $data->link = $request->txtLink;
                $filename        = time()."-".$file->getClientOriginalName();
                $destinationPath = 'images/uploads/sliders/';
                $file->move($destinationPath,$filename);
                $data->image    = $filename;
                $data->created_at = new DateTime();
                $data->save();
            }
            return redirect()->route('getSliderList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Đăng hình thành công!']);
        }
    }
    public function getSliderEdit ($id) {
        $data = Slider::findOrFail($id)->toArray();
        $json = json_encode($data);
        echo $json;
    }
    public function postSliderEdit (SliderEditRequest $request, $id) {
        $file           = $request->file('txtImage');
        $data = Slider::find($id);
        $data->status  = $request->txtStatus;
        $data->link = $request->txtLink;
        $data->id_user     = Auth::guard('admin')->user()->id;
        $data->updated_at = new DateTime();
        if (strlen($file) > 0) {//kiểm tra có file up lên hay không
            $image_current = $request->txtImage_Current;
            if (file_exists(public_path().'/images/uploads/sliders/'.$image_current)) {
                File::delete(public_path().'/images/uploads/sliders/'.$image_current);//nếu có file upload thì xóa hình cũ đi
                // hoặc dùng hàm unlink() của php
            }
            //thêm hình mới vào
            $filename        = time()."-".$file->getClientOriginalName();
            $destinationPath = 'images/uploads/sliders/';
            $file->move($destinationPath,$filename);
            $data->image  = $filename;
        }
        $data->save();
        return redirect()->route('getSliderList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật hình ảnh thành công!']);

    }
    public function getSliderDel ($id) {
        $data = Slider::findOrFail($id);
        $data_slider = $data->toArray();
        if (file_exists(public_path().'/images/uploads/sliders/'.$data_slider["image"])) {
            File::delete(public_path().'/images/uploads/sliders/'.$data_slider["image"]);
        }
        $data->delete();
        echo 'success';
    }
}
