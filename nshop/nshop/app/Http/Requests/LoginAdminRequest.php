<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
            'email'   => 'required|email',
            'password'   => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email bạn nhập chưa đúng định dạng',
            'password.required'  => 'Bạn chưa nhập mật khẩu',
        ];
    }
}
