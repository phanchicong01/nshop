<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtName'  => 'required',
            'txtCode'   => 'required|unique:products,code',
            'txtCategory'     => 'required',
            'txtContent'     => 'required',
            'txtPrice'         => 'required',
            'txtQuantity'         => 'required',
            'txtImage.*' => 'required|image|mimes:png,jpg,jpeg',
        ];
    }
    public function messages ()
    {
        return [
            'txtName.required'  => 'Tên sản phẩm không được để trống',
            'txtCode.required'   => 'Mã sản phẩm không được bỏ trống',
            'txtCode.unique'     => 'Mã sản phẩm này đã tồn tại',
            'txtCategory.required'     => 'Bạn chưa chọn danh mục sản phẩm',
            'txtContent.required'        => 'Nội dung không được để trống',
            'txtPrice.required'         => 'Giá sản phẩm không được để trống',
            'txtQuantity.required'     => 'Số lượng sản phẩm không được để trống',
            'txtImage.*.required' => 'Bạn chưa chọn hình sản phẩm',
            'txtImage.*.image'    => 'File bạn chọn không phải là hình',
            'txtImage.*.mimes'    => 'Định dạng hình ảnh phải là 1 trong các định dạng sau: png, jpg, jpeg',
        ];
    }
}
