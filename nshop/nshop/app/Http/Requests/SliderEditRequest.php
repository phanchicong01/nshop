<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderEditRequest extends FormRequest
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
            'txtImage.*' => 'required|image|mimes:png,jpg,jpeg',
        ];
    }
    public function messages ()
    {
        return [
            'txtImage.*.required' => 'Bạn chưa chọn hình ảnh',
            'txtImage.*.image'    => 'File bạn chọn không phải là hình',
            'txtImage.*.mimes'    => 'Định dạng hình phải thuộc các định dạng sau: png, jpg, jpeg'
        ];
    }
}
