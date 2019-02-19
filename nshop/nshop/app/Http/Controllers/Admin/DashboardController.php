<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getDashboard() {
        $count_product = Product::count();
        $count_comment = Comment::count();
        $count_order = Order::count();
        $count_user = User::count();
        $data_product_sell = Product::select('id', 'name', 'price', 'alias', 'count_sell')->orderBy('count_sell', 'DESC')->limit(5)->get()->toArray();
        $data_customer = User::select('name', 'email', 'created_at')->orderBy('created_at', 'DESC')->limit(5)->get()->toArray();
        $data_comment = Comment::with('product')->with('user')->select('id_user', 'id_product', 'content', 'created_at')->orderBy('created_at', 'DESC')->limit(5)->get()->toArray();
        return view('admin.modules.dashboard.dashboard', ['count_product' => $count_product, 'count_comment' => $count_comment, 'count_order' => $count_order, 'count_user' => $count_user, 'data_product_sell' => $data_product_sell, 'data_customer' => $data_customer, 'data_comment' => $data_comment]);
    }
}
