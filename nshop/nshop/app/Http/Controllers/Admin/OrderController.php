<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\DeliveryMethod;
class OrderController extends Controller
{
    public function getOrderList() {
        $data = Order::orderBy('created_at', 'DESC')->get()->toArray();
        return view('admin.modules.order.order-list', ['data' => $data]);
    }
    public function getOrderDetail($id) {
        $data = Order::where('id', $id)->first();
        $data_detail = OrderDetail::where('id_order', $id)->orderBy('created_at', 'DESC')->get()->toArray();
        $data_payment = PaymentMethod::select('name')->where('id', $data['id_payment'])->first();
        $data_delivery = DeliveryMethod::select('name')->where('id', $data['id_delivery'])->first();
        return view('admin.modules.order.order-detail', ['data' => $data, 'data_detail' => $data_detail, 'data_payment' => $data_payment, 'data_delivery' => $data_delivery]);
    }
    public function updateOrder($id) {
        Order::where('id', $id)->update(['status' => 1,  'payment' => 1]);
        return redirect()->route('getOrderDetail', ['id'=> $id]);
    }
    public function deleleOrder($id) {
        OrderDetail::where('id_order', $id)->delete();
        Order::where('id', $id)->delete();
        return redirect()->route('getOrderList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa đơn hàng thành công']);
    }
    public function ProcessPayment($id) {
        Order::where('id', $id)->update(['payment' => 1]);
        return redirect()->route('getOrderDetail', ['id'=> $id]);
    }
}
