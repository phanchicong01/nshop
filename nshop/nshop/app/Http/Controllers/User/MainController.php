<?php

namespace App\Http\Controllers\User;

use App\Models\ColorProduct;
use App\Models\ImageProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\SizeProduct;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerProfileEditRequest;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\CustomerProfileEditAvatarRequest;
use App\Http\Requests\CustomerProfileEditPasswordRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\News;
use App\Models\Comment;
use App\Models\Subscribe;
use App\Models\Slider;
use App\Models\Provision;
use App\Models\Guide;
use App\Models\Policy;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use BaoKimPayment, NL_CheckOutV3;
use DB, Cart, Mail, View, Auth, DateTime, File;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function __construct()
    {
        //global variable $slider => all view
        View::share ( 'count_item',  $count_item   = Cart::count());
    }
    public function getIndex() {
        $data_features = Product::select('id', 'name', 'alias', 'price', 'promotion')->where('status', 1)->where('hot_product', 1)->orderBy('updated_at', 'DESC')->get()->toArray();
        $data_news = News::select('id', 'name', 'alias', 'updated_at', 'image', 'intro','created_at')->where('status', 1)->orderBy('updated_at', 'DESC')->limit(6)->get()->toArray();
        $data_slider = Slider::select('image', 'link')->where('status', 1)->get()->toArray();
        return view('user.modules.home', ['data_features' => $data_features, 'data_news' => $data_news, 'data_slider' => $data_slider]);
    }
    public function getCategory($id, Request $request) {
        $price_from = intval($request->price_from);
        if($request->price_to != '')
            $price_to = intval($request->price_to);
        else
            $price_to = 10000000;
        $sort_array_value = array(1 => "created_at", 2 => "view", 3 => "count_sell", 4 => "price", 5 => "price");
        $sort_array = array(1 => "DESC", 2 => "DESC", 3 => "DESC", 4 => "DESC", 5 => "ASC");
        if($request->sort != '')
            $num_sort = intval($request->sort);
        else
            $num_sort = 1;
        $sort_value = $sort_array_value[$num_sort];
        $sort = $sort_array[$num_sort];

        $cate_count = Category::where('id_parent', $id)
                    ->where('status', 1)->count();
        if($cate_count != 0) {
            $cate_id_arr = Category::select('id')->where('id_parent', $id)->where('status', 1)->get()->toArray();
            if(isset($request->price_from) && isset($request->price_to))
                $data = Product::select('id', 'name', 'alias', 'price', 'promotion', 'content')->whereIn('id_cate', $cate_id_arr)->whereBetween('price', [$price_from, $price_to])->where('status', 1)->orderBy($sort_value, $sort)->paginate(9);
            else
                $data = Product::select('id', 'name', 'alias', 'price', 'promotion', 'content')->whereIn('id_cate', $cate_id_arr)->where('status', 1)->orderBy($sort_value, $sort)->paginate(9);
            $data_cate = Category::select('id', 'name', 'alias')->where('id_parent', $id)->where('status', 1)->get()->toArray();
            $data_hot = Product::select('id', 'name', 'alias', 'price')->whereIn('id_cate', $cate_id_arr)->where('hot_product', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(6)->get()->toArray();
            $cate_name = Category::select('name')->where('id', $id)->first();
            $cate_name_parent = '';
        }
        else {
            if(isset($request->price_from) && isset($request->price_to))
                $data = Product::select('id', 'name', 'alias', 'price', 'promotion', 'content')->where('id_cate', $id)->whereBetween('price', [$price_from, $price_to])->where('status', 1)->orderBy($sort_value, $sort)->paginate(9);
            else
                $data = Product::select('id', 'name', 'alias', 'price', 'promotion', 'content')->where('id_cate', $id)->where('status', 1)->orderBy($sort_value, $sort)->paginate(9);
            $cate_id_parent = Category::select('id_parent')->where('id', $id)->where('status', 1)->get()->toArray();
            $data_cate = Category::select('id', 'name', 'alias')->where('id_parent', $cate_id_parent)->where('id', '<>', $id)->where('status', 1)->get()->toArray();
            $data_hot = Product::select('id', 'name', 'alias', 'price')->where('id_cate', $id)->where('hot_product', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(6)->get()->toArray();
            $cate_name_parent = Category::select('id', 'name', 'alias')->where('id', $cate_id_parent)->first();
            $cate_name = Category::select('name')->where('id', $id)->first();
        }
        return view('user.modules.products-list', ['data' => $data, 'data_cate' => $data_cate, 'data_hot' => $data_hot, 'cate_name_parent' => $cate_name_parent, 'cate_name' => $cate_name]);
    }
    public function getProduct($id) {
        //update view
        $data_update = Product::find($id);
        $data_update->view =  $data_update->view + 1;
        $data_update->save();

        $data = Product::with('cate')->select('id', 'name', 'alias', 'price', 'promotion', 'content', 'description', 'keyword', 'id_cate')->where('id', $id)->where('status', 1)->first();
        $image_data = ImageProduct::select('image')->where('id_product', $id)->limit(4)->get()->toArray();
        $size_data = SizeProduct::select('size')->where('id_product', $id)-> get() ->toArray();
        $color_data = ColorProduct::select('color')->where('id_product', $id)->get()->toArray();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(4)->get()->toArray();
        $data_comment = Comment::with('user')->where('id_product', $id)->get()->toArray();
        $comment_count = Comment::with('user')->where('id_product', $id)->count();
        $data_cate =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('id_cate', $data['cate']['id'])->where('status', 1)->where('id', '<>',$data['id'])->orderBy(DB::raw('RAND()'))->limit(8)->get()->toArray();
        return view('user.modules.product-detail', ['data' => $data, 'image_data' => $image_data, 'size_data' => $size_data, 'color_data' => $color_data, 'data_hot' => $data_hot, 'data_cate' => $data_cate, 'data_comment' => $data_comment, 'comment_count' => $comment_count]);
    }
    public function getNews() {
        $data = News::select('id', 'name', 'intro', 'alias', 'image', 'created_at')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.news-list', ['data' => $data, 'data_hot' => $data_hot]);
    }
    public function getNewsDetail($id) {
        $data = News::where('id', $id)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.news-detail', ['data' => $data, 'data_hot' => $data_hot]);
    }
    public function getSearchProduct(Request $request) {
        $keyword = $request->keyword;
        $price_from = intval($request->price_from);
        if($request->price_to != '')
            $price_to = intval($request->price_to);
        else
            $price_to = 10000000;
        $sort_array_value = array(1 => "created_at", 2 => "view", 3 => "count_sell", 4 => "price", 5 => "price");
        $sort_array = array(1 => "DESC", 2 => "DESC", 3 => "DESC", 4 => "DESC", 5 => "ASC");
        if($request->sort != '')
            $num_sort = intval($request->sort);
        else
            $num_sort = 1;
        $sort_value = $sort_array_value[$num_sort];
        $sort = $sort_array[$num_sort];
        if(isset($request->price_from) && isset($request->price_to))
            $data = Product::select('id', 'name', 'alias', 'price', 'promotion', 'content')->where("name", "LIKE","%$keyword%")->whereBetween('price', [$price_from, $price_to])->where('status', 1)->orderBy($sort_value, $sort)->paginate(9);
        else
            $data = Product::select('id', 'name', 'alias', 'price', 'promotion', 'content')->where("name", "LIKE","%$keyword%")->where('status', 1)->orderBy($sort_value, $sort)->paginate(9);
        $data_hot = Product::select('id', 'name', 'alias', 'price')->where('hot_product', 1)->where('status', 1)->orderBy('updated_at', 'DESC')->limit(6)->get()->toArray();
        return view('user.modules.search-product', ['data' => $data, 'data_hot' => $data_hot]);
    }

    //Cart
    public function addCart(Request $request) {
        $id = $request->id;
        $quantity = $request->quantity;
        $size = $request->size;
        $color = $request->color;

        $data = Product::where('id',$id)->first();
        $image_data = getImageProduct($id);
        if ($color != '' && $size == '') {
            Cart::add(array('id' => $id, 'name' => $data->name, 'qty' => $quantity, 'price' => $data->price, 'options' => array('img' => $image_data->image, 'color' => $color, 'code' => $data->code)));
        }
        if ($color == '' && $size != '') {
            Cart::add(array('id' => $id, 'name' => $data->name, 'qty' => $quantity, 'price' => $data->price, 'options' => array('img' => $image_data->image, 'size' => $size, 'code' => $data->code)));
        }
        if ($color != '' && $size != '') {
            Cart::add(array('id' => $id, 'name' => $data->name, 'qty' => $quantity, 'price' => $data->price, 'options' => array('img' => $image_data->image, 'size' => $size, 'color' => $color, 'code' => $data->code)));
        }
        return redirect()->route('getCart');
    }
    public function getCart() {
        $content = Cart::content();
        $total = Cart::total();
        $count_item = Cart::count();
        return view('user.modules.cart', ["content" => $content, "total" => $total, "count_item" => $count_item]);
    }
    public function delItemCart($id) {
        Cart::remove($id);
        echo 'success';
    }
    public function updateItemCart($id, $qty) {
        Cart::update($id,$qty);
        echo "success";
    }
    public function checkOut() {
        $content = Cart::content();
        $total = Cart::total();
        $data_payment = PaymentMethod::select('id', 'name')->get()->toArray();
        $data_delivery = DeliveryMethod::select('id', 'name', 'tax_ship')->get()->toArray();
        return view('user.modules.checkout', ['content' => $content, 'total' => $total, 'data_payment' => $data_payment, 'data_delivery' => $data_delivery]);
    }
      public function getOrderDetail($id) {
        $data = Order::where('id', $id)->first();
        $data_detail = OrderDetail::where('id_order', $id)->orderBy('created_at', 'DESC')->get()->toArray();
        $data_payment = PaymentMethod::select('name')->where('id', $data['id_payment'])->first();
        $data_delivery = DeliveryMethod::select('name')->where('id', $data['id_delivery'])->first();
        return view('user.modules.order-detail', ['data' => $data, 'data_detail' => $data_detail, 'data_payment' => $data_payment, 'data_delivery' => $data_delivery]);
    }
    public function saveOrder(Request $request) {
        $code_order = 'DH'.time();
        $payment_method = $request->txtPayment;
        $delivery_method = $request->txtDelivery;
        $total   = Cart::total();
        $count_item    = Cart::count();
        if ($payment_method == 1) {//thanh toán trực tiếp
            $data = new Order();
            $data->code_order = $code_order;
            if (Auth::guard('user')->check())
                $data->id_user = Auth::guard('user')->user()->id;
            $data->receiver_name = $request->txtName;
            $data->receiver_phone = $request->txtPhone;
            $data->receiver_address = $request->txtAddress;
            $data->note = $request->txtNote;
            $data->id_payment = $payment_method;
            $data->id_delivery = $delivery_method;
            $data->created_at = new DateTime();
            $data->save();
            $cart_content = Cart::content();
            foreach ($cart_content as $item) {
                $data_detail = new OrderDetail();
                $data_detail->id_order = $data->id;
                $data_detail->id_product = $item->id;
                $data_detail->code_item = $item->rowId;
                if(isset($item->options['size'])&& $item->options['size'] != '')
                    $data_detail->size = $item->options['size'];
                if(isset($item->options['color'])&& $item->options['color'] != '')
                    $data_detail->color = $item->options['color'];
                $data_detail->quantity = $item->qty;
                $data_detail->price = $item->price;
                $data_detail->save();
            }
            $email = $request->txtEmail;
            $name = $request->txtName;
            $data = ['name' => $request->txtName, 'address' => $request->txtAddress, 'phone' => $request->txtPhone, 'note' => $request->txtNote, 'total' => $total, 'count_item' => $count_item, 'code_order' => $code_order, 'payment_method' => 'Thanh toán trực tiếp khi nhận hàng'];
            Mail::send('user.mail.order-info', $data, function ($message) use ($email, $name) {
                $message->from('phanchicong01@gmail.com', 'nshop.dev');
                $message->to($email, $name);
                $message->subject('Thông Tin Đơn Đặt Hàng Từ nshop');
            });
            //save count_sell in table products
            $cart_content = Cart::content();
            foreach ($cart_content as $item) {
                $data_update = Product::find($item->id);
                $data_update->count_sell = $data_update->count_sell + 1;
                $data_update->save();
            }
            Cart::destroy();
            return redirect()->route('index')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Đặt hàng thành công!']);

        }
//        else if ($payment_method == 2) {//thanh toán qua Ngân Lượng
//            // Lưu vào đơn hàng
//            $data = new Order();
//            $data->code_order = $code_order;
//            if (Auth::guard('user')->check())
//                $data->id_user = Auth::guard('user')->user()->id;
//            $data->receiver_name = $request->txtName;
//            $data->receiver_phone = $request->txtPhone;
//            $data->receiver_address = $request->txtAddress;
//            $data->note = $request->txtNote;
//            $data->id_payment = $payment_method;
//            $data->id_delivery = $delivery_method;
//            $data->created_at = new DateTime();
//
//            $data->save();
//            // Lưu vào đơn hàng chi tiết
//            $cart_content = Cart::content();
//            foreach ($cart_content as $item) {
//                $data_detail = new OrderDetail();
//                $data_detail->id_order = $data->id;
//                $data_detail->id_product = $item->id;
//                $data_detail->code_item = $item->rowId;
//                if(isset($item->options['size'])&& $item->options['size'] != '')
//                    $data_detail->size = $item->options['size'];
//                if(isset($item->options['color'])&& $item->options['color'] != '')
//                    $data_detail->color = $item->options['color'];
//                $data_detail->quantity = $item->qty;
//                $data_detail->price = $item->price;
//                $data_detail->save();
//            }
//            $email = $request->txtEmail;
//            $name = $request->txtName;
//            $data = ['name' => $request->txtName, 'address' => $request->txtAddress, 'phone' => $request->txtPhone, 'note' => $request->txtNote, 'total' => $total, 'count_item' => $count_item, 'code_order' => $code_order, 'payment_method' => 'Qua cổng thanh toán trực tuyến Ngân Lượng'];
//            Mail::send('user.mail.order-info', $data, function ($message) use ($email, $name) {
//                $message->from('phanchicong01@gmail.com', 'nshop.dev');
//                $message->to($email, $name);
//                $message->subject('Thông Tin Đơn Đặt Hàng Từ nshop.dev');
//            });
//
//            //save count_sell in table products
//            $cart_content = Cart::content();
//            foreach ($cart_content as $item) {
//                $data_update = Product::find($item->id);
//                $data_update->count_sell = $data_update->count_sell + 1;
//                $data_update->save();
//            }
//            Cart::destroy();
//            //Thông tin thanh toán qua Ngân Lượng
//            $nlcheckout   = new NL_CheckOutV3(MERCHANT_ID,MERCHANT_PASS,RECEIVER,URL_API);
//            $total_amount = $total;//Giá trị đơn hàng
//
//            $array_items[0]= array('item_name1' => 'Thanh toán đơn hàng tại nshop.dev',
//                'item_quantity1' => $count_item,
//                'item_amount1' => $total_amount,
//                'item_url1' => 'http://shop.nhatle.net/');
//
//            $array_items            =array();
//            $payment_method         ="NL";
//
//            $order_code             =$code_order;
//
//            $payment_type           ='';
//            $discount_amount        =0;
//            $order_description      ='Thanh toán đơn hàng tại nshop.dev';
//            $tax_amount             =0;
//            $fee_shipping           =0;
//            $url_thanhtoanthanhcong = "thanh-toan-ngan-luong-thanh-cong/".$code_order;
//            $return_url             =url($url_thanhtoanthanhcong);
//            $cancel_url             =url('/thanh-toan-khong-thanh-cong');//URL_CANCEL;
//
//            $buyer_fullname         =$request->txtName;
//            $buyer_email            =$request->txtEmail;
//            $buyer_mobile           =$request->txtPhone;
//            $buyer_address          =$request->txtAddress;
//            $bank_code = '';
//
//            if($payment_method !='' && $buyer_email !="" && $buyer_mobile !="" && $buyer_fullname !="" && filter_var( $buyer_email, FILTER_VALIDATE_EMAIL )  ){
//                if($payment_method =="VISA"){
//
//                    $nl_result= $nlcheckout->VisaCheckout($order_code,$total_amount,$payment_type,$order_description,$tax_amount,
//                        $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile,
//                        $buyer_address,$array_items,$bank_code);
//
//                }elseif($payment_method =="NL"){
//                    $nl_result= $nlcheckout->NLCheckout($order_code,$total_amount,$payment_type,$order_description,$tax_amount,$fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile,$buyer_address,$array_items);
//
//                }elseif($payment_method =="ATM_ONLINE" && $bank_code !='' ){
//                    $nl_result= $nlcheckout->BankCheckout($order_code,$total_amount,$bank_code,$payment_type,$order_description,$tax_amount,
//                        $fee_shipping,$discount_amount,$return_url,$cancel_url,$buyer_fullname,$buyer_email,$buyer_mobile,
//                        $buyer_address,$array_items) ;
//                }
//                elseif($payment_method =="NH_OFFLINE"){
//                    $nl_result= $nlcheckout->officeBankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
//                }
//                elseif($payment_method =="ATM_OFFLINE"){
//                    $nl_result= $nlcheckout->BankOfflineCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
//
//                }
//                elseif($payment_method =="IB_ONLINE"){
//                    $nl_result= $nlcheckout->IBCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
//                }
//            }
//            //var_dump($nl_result); die;
//            if ($nl_result->error_code =='00'){
//
//                //Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
//                ?>
<!--                <script type="text/javascript">-->
<!--                    <!---->
<!--                    window.location = "--><?php //echo(string)$nl_result->checkout_url; // .'&lang=en' chuyển mặc định tiếng anh  ?>//"
//                    //-->
//                </script>
//                <?PHP
//            }else{
//                echo $nl_result->error_message;
//            }
//        }
//        else if ($payment_method == 3) {//Thanh toán qua Bảo Kim
//            // Thông tin để thanh toán bên Bảo Kim
//            $order_id               = $code_order;// Mã đơn Hàng
//            $url_thanhtoanthanhcong = "thanh-toan-bao-kim-thanh-cong/".$code_order;
//            $business               = "quinhatpy@gmail.com";//EMAIL_BUYER;
//            $total_amount           = $total;//Giá trị đơn hàng
//            $url_success            =  url($url_thanhtoanthanhcong);//URL_SUCCESS;
//            $url_cancel             = url('/thanh-toan-khong-thanh-cong');//URL_CANCEL;
//            $shipping_fee           =0;
//            $tax_fee                =0;
//            $order_description      ='Thanh toán đơn hàng tại nshop.dev';
//            $url_detail             ='';
//            // --------------------------------------------------------------
//            $data = new Order();
//            $data->code_order = $code_order;
//            if (Auth::guard('user')->check())
//                $data->id_user = Auth::guard('user')->user()->id;
//            $data->receiver_name = $request->txtName;
//            $data->receiver_phone = $request->txtPhone;
//            $data->receiver_address = $request->txtAddress;
//            $data->note = $request->txtNote;
//            $data->id_payment = $payment_method;
//            $data->id_delivery = $delivery_method;
//            $data->created_at = new DateTime();
//            $data->save();
//            $cart_content = Cart::content();
//            foreach ($cart_content as $item) {
//                $data_detail = new OrderDetail();
//                $data_detail->id_order = $data->id;
//                $data_detail->id_product = $item->id;
//                $data_detail->code_item = $item->rowId;
//                if(isset($item->options['size'])&& $item->options['size'] != '')
//                    $data_detail->size = $item->options['size'];
//                if(isset($item->options['color'])&& $item->options['color'] != '')
//                    $data_detail->color = $item->options['color'];
//                $data_detail->quantity = $item->qty;
//                $data_detail->price = $item->price;
//                $data_detail->save();
//            }
//            //save count_sell in table products
//            $cart_content = Cart::content();
//            foreach ($cart_content as $item) {
//                $data_update = Product::find($item->id);
//                $data_update->count_sell = $data_update->count_sell + 1;
//                $data_update->save();
//            }
//            Cart::destroy();
//            $email = $request->txtEmail;
//            $name = $request->txtName;
//            $data = ['name' => $request->txtName, 'address' => $request->txtAddress, 'phone' => $request->txtPhone, 'note' => $request->txtNote, 'total' => $total, 'count_item' => $count_item, 'code_order' => $code_order, 'payment_method' => 'Qua cổng thanh toán trực tuyến Bảo Kim'];
//            Mail::send('user.mail.order-info', $data, function ($message) use ($email, $name) {
//                $message->from('phanchicong01@gmail.com\', \'nshop.dev');
//                $message->to($email, $name);
//                $message->subject('Thông Tin Đơn Đặt Hàng Từ nshop.dev');
//            });
//            $bkim = new BaoKimPayment;
//            $url= $bkim->createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail);
//            return redirect($url);
//        }
    }

//    public function getCheckoutBaoKimSC ($id) {
//        Order::where('code_order', $id)->update(['payment' => 1]);
//        return redirect()->route('index')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Đặt hàng và thanh toán thành công!']);
//    }
    public function getCustomerProfile($id) {
        $data = User::select('email', 'name', 'address', 'phone', 'avatar', 'gender', 'birthday')->where('id', $id)->first();
        $order_count = Order::where('id_user', $id)->count();
        $comment_count = Comment::where('id_user', $id)->count();
        $order_data = Order::select('id','id_user', 'code_order', 'created_at', 'status')->where('id_user',$id)->get()->toArray();
        $comment_data = Comment::with('product')->select('content', 'created_at', 'id_product')->where('id_user',$id)->get()->toArray();
        return view('user.modules.customer-profile', ['data' => $data, 'order_count' => $order_count, 'order_data' => $order_data, 'comment_count' => $comment_count,'comment_data' => $comment_data]);
    }
    public function getCustomerProfileEdit($id) {
        $data = User::select('email', 'name', 'address', 'phone', 'avatar', 'gender', 'birthday')->where('id', $id)->first();
        return view('user.modules.customer-profile-edit', ['data' => $data]);
    }
    public function postCustomerProfileEdit(CustomerProfileEditRequest $request) {
        $data             = User::find($request->idUser);
        $data->name      = $request->txtName;
        $data->phone       = $request->txtPhone;
        $data->address     = $request->txtAddress;
        $data->gender = $request->txtGender;
        $data->birthday = date("Y-m-d", strtotime(str_replace('/', '-', $request->txtBirthday)));
        $data->updated_at = new DateTime();
        $data->save();
        return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật thông tin thành công!']);
    }
    public function postCustomerProfileEditAvatar (CustomerProfileEditAvatarRequest $request) {
        $data             = User::find($request->idUser);
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
        $data->updated_at = new DateTime();
        $data->save();
        return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật ảnh đại diện thành công!']);
    }
    public function postCustomerProfileEditPassword (CustomerProfileEditPasswordRequest $request) {
        $data             = User::find($request->idUser);
        $data_user = $data->get()->toArray();
        if (Hash::check($request->txtPassword,Auth::guard('user')->user($request->idUser)->password)) {
            if ($request->txtPasswordNew != '')
                $data->password = bcrypt($request->txtPasswordNew);
            $data->updated_at = new DateTime;
            $data->save();
            return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Cập nhật mật khẩu mới thành công!']);
        }
        else{
            return redirect()->back()->with(['flash_level' => 'error_msg', 'flash_messages' => 'Mật khẩu hiện tại không chính xác!']);
        }
    }
    public function postComment($id, CommentRequest $request) {
        $data = new Comment();
//        dd(Auth::guard('user')->user()->id);
        $data->id_product = $id;
        $data->id_user = Auth::guard('user')->user()->id;
        $data->content = $request->txtContent;
        $data->created_at = new DateTime;
        $data->save();
        return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Đăng bình luận thành công!']);
    }
    public function postSubscribe(SubscribeRequest $request) {
        $data = new Subscribe();
        $data->email = $request->txtEmail;
        $data->created_at = new DateTime;
        $data->save();
        return redirect()->back()->with(['flash_level' => 'result_msg', 'flash_messages' => 'Đăng ký thành công! Cảm ơn bạn đã tin tưởng sử dụng website của chúng tôi.']);
    }

    public function getDKDV () {
        $data = Provision::where('id', 1)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getDKMH () {
        $data = Provision::where('id', 2)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getDKTT () {
        $data = Provision::where('id', 3)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getDKVC () {
        $data = Provision::where('id', 4)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getCSBM () {
        $data = Policy::where('id', 1)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getCSVC () {
        $data = Policy::where('id', 2)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getCSDT () {
        $data = Policy::where('id', 3)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getCSMH () {
        $data = Policy::where('id', 4)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getHDMH () {
        $data = Guide::where('id', 1)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getHDTT () {
        $data = Guide::where('id', 2)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getHDGN () {
        $data = Guide::where('id', 3)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
    public function getHDDT () {
        $data = Guide::where('id', 4)->first();
        $data_hot =  Product::select('id', 'name', 'alias', 'price', 'promotion')->where('hot_product', 1)->where('status', 1)->limit(6)->get()->toArray();
        return view('user.modules.single-page', ["data" => $data, 'data_hot' => $data_hot]);
    }
}
