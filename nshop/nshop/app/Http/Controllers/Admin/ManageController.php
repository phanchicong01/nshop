<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\InfoPageRequest;
use App\Http\Requests\ProvisionRequest;
use App\Http\Controllers\Controller;
use App\Models\InfoPage;
use App\Models\Provision;
use App\Models\Policy;
use App\Models\Guide;
use DateTime;

class ManageController extends Controller
{
    //title, description, keyword
    public function getInfoPageEdit () {
        $data = InfoPage::select('*')->get()->toArray();
        return view('admin.modules.manage.info-page', ["data" => $data]);
    }
    public function postInfoPageEdit (InfoPageRequest $request) {
        $data             = InfoPage::findOrFail(1);;
        $data->title       = $request->txtTitle;
        $data->description       = $request->txtDescription;
        $data->keyword     = $request->txtKeyword;
        $data->updated_at = new DateTime();
        $data->save();
        return redirect()->route('getInfoPageEdit')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thành công']);
    }
    //điều khoản
    public function getProvisionEdit () {
        $data = Provision::select('*')->get()->toArray();
        return view('admin.modules.manage.provision-page', ["data" => $data]);

    }
    public function postProvisionEdit (ProvisionRequest $request) {
        $data1             = Provision::findOrFail(1);;
        $data1->content    = $request->txtContent1;
        $data1->updated_at = new DateTime();
        $data1->save();

        $data2             = Provision::findOrFail(2);;
        $data2->content    = $request->txtContent2;
        $data2->updated_at = new DateTime();
        $data2->save();

        $data3             = Provision::findOrFail(3);;
        $data3->content    = $request->txtContent3;
        $data3->updated_at = new DateTime();
        $data3->save();

        $data4             = Provision::findOrFail(4);;
        $data4->content    = $request->txtContent4;
        $data4->updated_at = new DateTime();
        $data4->save();
        return redirect()->route('getProvisionEdit')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thành công']);
    }
    //điều khoản
    public function getPolicyEdit () {
        $data = Policy::select('*')->get()->toArray();
        return view('admin.modules.manage.policy-page', ["data" => $data]);

    }
    public function postPolicyEdit (ProvisionRequest $request) {
        $data1             = Policy::findOrFail(1);;
        $data1->content    = $request->txtContent1;
        $data1->updated_at = new DateTime();
        $data1->save();

        $data2             = Policy::findOrFail(2);;
        $data2->content    = $request->txtContent2;
        $data2->updated_at = new DateTime();
        $data2->save();

        $data3             = Policy::findOrFail(3);;
        $data3->content    = $request->txtContent3;
        $data3->updated_at = new DateTime();
        $data3->save();

        $data4             = Policy::findOrFail(4);;
        $data4->content    = $request->txtContent4;
        $data4->updated_at = new DateTime();
        $data4->save();
        return redirect()->route('getPolicyEdit')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thành công']);
    }
    //hướng dẫn
    public function getGuideEdit () {
        $data = Guide::select('*')->get()->toArray();
        return view('admin.modules.manage.guide-page', ["data" => $data]);

    }
    public function postGuideEdit (ProvisionRequest $request) {
        $data1             = Guide::findOrFail(1);;
        $data1->content    = $request->txtContent1;
        $data1->updated_at = new DateTime();
        $data1->save();

        $data2             = Guide::findOrFail(2);;
        $data2->content    = $request->txtContent2;
        $data2->updated_at = new DateTime();
        $data2->save();

        $data3             = Guide::findOrFail(3);;
        $data3->content    = $request->txtContent3;
        $data3->updated_at = new DateTime();
        $data3->save();

        $data4             = Guide::findOrFail(4);;
        $data4->content    = $request->txtContent4;
        $data4->updated_at = new DateTime();
        $data4->save();
        return redirect()->route('getPolicyEdit')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thành công']);
    }
}
