<?php

namespace App\Http\Controllers\Admin;

use Faker\Provider\hy_AM\Color;
use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductEditRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\SizeProduct;
use App\Models\ColorProduct;
use Auth, File, DateTime;
class ProductController extends Controller
{
    public function getProductAdd () {
        $data_cate = Category::select('id', 'name', 'id_parent')->get()->toArray();
        return view('admin.modules.product.product-add', ['data_cate' => $data_cate]);
    }
    public function postProductAdd (ProductAddRequest $request) {
        $data             = new Product();
        $data->code     = $request->txtCode;
        $data->name    = $request->txtName;
        $data->content  = $request->txtContent;
        $data->price      = $request->txtPrice;
        $data->quantity  = $request->txtQuantity;
        $data->alias      = str_slug($request->txtName, '-');
        $data->keyword     = $request->txtKeyword;
        $data->description     = $request->txtDescription;
        if ($request->txtPromotion == 1) {
            $data->promotion = $request->txtPromotionData;
        }
        if($request->txtHotProduct != '')
            $data->hot_product = $request->txtHotProduct;
        else $data->hot_product = 0;
        if($request->txtStatus != '')
            $data->status = $request->txtStatus;
        else $data->status = 0;
        $data->id_cate     = $request->txtCategory;
        $data->id_user     = Auth::guard('admin')->user()->id;
        $data->created_at = new DateTime();
        $data_saved = $data->save();
        if($data_saved) {
            //process image
            if ($request->hasFile('txtImage')) {
                $files = $request->file('txtImage');
                foreach ($files as $file) {
                    $img_data = new ImageProduct();
                    $filename = time() . "-" . $file->getClientOriginalName();
                    $destinationPath = 'images/uploads/products/';
                    $file->move($destinationPath, $filename);
                    $img_data->id_product = $data->id;
                    $img_data->image = $filename;
                    $img_data->status = 1;
                    $img_data->created_at = new DateTime();
                    $img_data->save();
                }
            }
            //process size
            if ($request->txtSize != '') {
                $data_request = explode(",",$request->txtSize);
                foreach($data_request as $value) {
                    $size_data             = new SizeProduct();
                    $size_data->id_product       = $data->id;
                    $size_data->size       = trim($value);
                    $size_data->created_at = new DateTime();
                    $size_data->save();
                }
            }
            //process color
            if ($request->txtColor != '') {
                $data_request = explode(",",$request->txtColor);
                foreach($data_request as $value) {
                    $color_data             = new ColorProduct();
                    $color_data->id_product       = $data->id;
                    $color_data->color        = trim($value);
                    $color_data->created_at = new DateTime();
                    $color_data->save();
                }
            }
        }
        return redirect()->route('getProductList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Thêm sản phẩm thành công!']);
    }
    public function getProductList () {
        $data = Product::with('cate')->with('user')->select('id', 'code','name', 'price', 'quantity','status', 'alias', 'id_user', 'id_cate', 'promotion', 'hot_product', 'created_at')->orderBy('created_at', 'DESC')->get()->toArray();
        return view('admin.modules.product.product-list', ['data' => $data]);
    }
    public function getProductDel ($id) {
        SizeProduct::where('id_product', $id)->delete();
        $image_data = ImageProduct::where('id_product', $id)->get()->toArray();
        foreach ($image_data as $value) {
            if (file_exists(public_path().'/images/uploads/products/'.$value["image"])) {
                File::delete(public_path().'/images/uploads/products/'.$value["image"]);
            }
        }
        ImageProduct::where('id_product', $id)->delete();
        ColorProduct::where('id_product', $id)->delete();
        Product::find($id)->delete();
        return redirect()->route('getProductList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Xóa sản phẩm thành công!']);
    }
    public function getProductEdit ($id) {
        $data = Product::where('id', $id)->firstOrFail();
        $cate_data = Category::select('id', 'name', 'id_parent')->get()->toArray();
        $size_data = SizeProduct::where('id_product', $id)->get()->toArray();
        $color_data = ColorProduct::where('id_product', $id)->get()->toArray();
        $image_data = ImageProduct::where('id_product', $id)->get()->toArray();
        return view('admin.modules.product.product-edit', ["data" => $data, "cate_data" => $cate_data, "size_data" => $size_data, "color_data" => $color_data, "image_data" => $image_data]);
    }
    public function postProductEdit (ProductEditRequest $request, $id) {
        $data = Product::find($id);
        $data->code     = $request->txtCode;
        $data->name    = $request->txtName;
        $data->content  = $request->txtContent;
        $data->price      = $request->txtPrice;
        $data->quantity  = $request->txtQuantity;
        $data->alias      = str_slug($request->txtName, '-');
        $data->keyword     = $request->txtKeyword;
        $data->description     = $request->txtDescription;
        if ($request->txtPromotion == 1)
            $data->promotion = $request->txtPromotionData;
        else
            $data->promotion = null;
        if($request->txtHotProduct != '')
            $data->hot_product = $request->txtHotProduct;
        else $data->hot_product = 0;
        if($request->txtStatus != '')
            $data->status = $request->txtStatus;
        else $data->status = 0;
        $data->id_cate     = $request->txtCategory;
        $data->id_user     = Auth::guard('admin')->user()->id;
        $data->updated_at = new DateTime();
        $data_saved = $data->save();
        if($data_saved) {
            //process image
            if ($request->hasFile('txtImage')) {
                $files = $request->file('txtImage');
                foreach ($files as $file) {
                    $img_data = new ImageProduct();
                    $filename = time() . "-" . $file->getClientOriginalName();
                    $destinationPath = 'images/uploads/products/';
                    $file->move($destinationPath, $filename);
                    $img_data->id_product = $id;
                    $img_data->image = $filename;
                    $img_data->status = 1;
                    $img_data->created_at = new DateTime();
                    $img_data->save();
                }
            }
            //process size
            if ($request->txtSize != '') {
                SizeProduct::where('id_product', $id)->delete();
                $data_request = explode(",",$request->txtSize);
                foreach($data_request as $value) {
                    $size_data             = new SizeProduct();
                    $size_data->id_product       = $id;
                    $size_data->size       = trim($value);
                    $size_data->created_at = new DateTime();
                    $size_data->save();
                }
            }
            //process color
            if ($request->txtColor != '') {
                ColorProduct::where('id_product', $id)->delete();
                $data_request = explode(",",$request->txtColor);
                foreach($data_request as $value) {
                    $color_data             = new ColorProduct();
                    $color_data->id_product       = $id;
                    $color_data->color        = trim($value);
                    $color_data->created_at = new DateTime();
                    $color_data->save();
                }
            }
        }
        return redirect()->route('getProductList')->with(['flash_level' => 'result_msg', 'flash_messages' => 'Sửa sản phẩm thành công!']);
    }
    public function delImageProduct ($id, $image) {
        if (file_exists(public_path().'/images/uploads/products/'.$image)) {
            File::delete(public_path().'/images/uploads/products/'.$image);
            ImageProduct::find($id)->delete();
            echo "success";
        }
    }
}
