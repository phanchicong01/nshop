<?php
/**
 * Created by Chi Công
 * User: phanchicong01@gmail.com
 * Date: 09-Dec-16
 * Time: 08:09
 */
function menuMulti($data, $id_parent = 0, $str = "--| ", $select = 0)
{
    foreach ($data as $value) {
        $id = $value["id"];
        $name = $value["name"];
        if ($value["id_parent"] == $id_parent) {
            if ($select != 0 && $id == $select) {
                echo '<option value="' . $id . '" selected>' . $str . $name . '</option>';
            } else {
                echo '<option value="' . $id . '">' . $str . $name . '</option>';
            }
            menuMulti($data, $id, $str . " --| ", $select);
        }
    }
}
function getImageProduct($id) {
    return  \App\Models\ImageProduct::where('id_product', $id)->first();
}
function getSizeProduct($id) {
    return \App\Models\SizeProduct::where('id_product', $id)->get()->toArray();
}
function getColorProduct($id) {
    return \App\Models\ColorProduct::where('id_product', $id)->get()->toArray();
}
function getImageProductFront($id) {
    return  \App\Models\ImageProduct::where('id_product', $id)->limit(2)->get()->toArray();
}
function getProductData($id_cate) {
    return \App\Models\Product::select('id', 'name', 'alias', 'price', 'promotion')->where('id_cate', $id_cate)->where('status', 1)->orderBy('updated_at', 'DESC')->get()->toArray();
}
function cutString($str, $length, $minword = 3) {
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;//kiem tra neu la chu dau thi ghep '' voi tu dau tien, neu sub khong rong tuc la khong phai chu dau => ghep voi khoang trang ' '
        $sub .= $part;//noi cac tu lai voi nhau
        $len += strlen($part);//dem do dai cua cac tu duoc tach ra
        //=== Neu do dai cua mot chu > do dai toi thieu cua mot chu va do dai cua cau da ghep duoc > so chu muon lay thi dung lai
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
    return $sub . (($len < strlen($str)) ? '...' : '');
}
function getOrderDetail($id) {
    $data = \App\Models\OrderDetail::where('id_order', $id);
    $data_get = $data->get()->toArray();
    $sum = 0;
    foreach ($data_get as $item)
        $sum += $item['quantity'] * $item['price'];
    return ['count_item' => $data->count(), 'sum' => $sum];
}
function countVisit() {
    //Tang so luot truy cap
    if(!\Illuminate\Support\Facades\Session::has('visit'))
    {
        $data = \App\Models\Visit::first();
        $count = $data->count;
        DB::table('visit')->update(['count' => $count + 1]);
        \Illuminate\Support\Facades\Session::put('visit', 1);
    }
    return \App\Models\Visit::first();
}