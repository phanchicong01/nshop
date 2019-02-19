<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoPageRequest extends FormRequest
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
            'txtTitle'   => 'required',
            'txtDescription'   => 'required',
            'txtKeyword'   => 'required'
        ];
    }
    public function messages()
    {
        return [
            'txtTitle.required' => 'Không được bỏ trống tiêu đề trang',
            'txtDescription.required'  => 'Không được bỏ trống mô tả trang',
            'txtKeyword.required'  => 'Không được bỏ trống từ khóa',
        ];
    }
}
