<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'txtCode'   => 'required',
            'txtCategory'     => 'required',
            'txtContent'     => 'required',
            'txtPrice'         => 'required',
            'txtQuantity'         => 'required',
            'txtImage.*' => 'image|mimes:png,jpg,jpeg',
        ];
    }
    public function messages ()
    {
        return [
            'txtName.required'  => 'Tên sản phẩm không được để trống',
            'txtCode.required'   => 'Mã sản phẩm không được bỏ trống',
            'txtCategory.required'     => 'Bạn chưa chọn danh mục sản phẩm',
            'txtContent.required'        => 'Nội dung không được để trống',
            'txtPrice.required'         => 'Giá sản phẩm không được để trống',
            'txtQuantity.required'     => 'Số lượng sản phẩm không được để trống',
            'txtImage.*.image'    => 'File bạn chọn không phải là hình',
            'txtImage.*.mimes'    => 'Định dạng hình ảnh phải là 1 trong các định dạng sau: png, jpg, jpeg',
        ];
    }
}
