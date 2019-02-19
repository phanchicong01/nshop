<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CateAddRequest extends FormRequest
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
            'txtName' => 'required|unique:categories,name'
        ];
    }
    public function messages ()
    {
        return [
            'txtName.required' => 'Tên danh mục không được bỏ trống',
            'txtName.unique' => 'Danh mục này đã tồn tại!'
        ];
    }
}
