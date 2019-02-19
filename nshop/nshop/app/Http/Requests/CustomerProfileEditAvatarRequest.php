<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerProfileEditAvatarRequest extends FormRequest
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
            'txtAvatar' => 'required|image|mimes:png,jpg,jpeg',
        ];
    }
    public function messages ()
    {
        return [
            'avatar.required' => 'Bạn chưa chọn hình đại diện',
            'txtAvatar.image'    => 'File bạn chọn không phải là hình.',
            'txtAvatar.mimes'    => 'Hình của bạn phải là 1 trong các định dạng sau: png, jpg, jpeg.'
        ];
    }
}
