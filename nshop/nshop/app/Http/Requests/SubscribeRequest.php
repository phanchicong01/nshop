<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
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
            'txtEmail' => 'required|unique:subscribes,email|email',
        ];
    }
    public function messages ()
    {
        return [
            'txtEmail.required' => 'Email không được để trống',
            'txtEmail.unique'   => 'Email này đã được đăng ký',
            'txtEmail.email'   => 'Email này không hợp lệ',
        ];
    }
}
