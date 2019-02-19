<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerProfileEditPasswordRequest extends FormRequest
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
            'txtPassword' => 'required',
            'txtPasswordNew' => 'required',
            'txtRePasswordNew' => 'required|same:txtPasswordNew',
        ];
    }
    public function messages()
    {
        return [
            'txtPassword.required'  => 'Mật khẩu hiện tại không được để trống',
            'txtPasswordNew.required'  => 'Mật khẩu mới không được để trống',
            'txtRePasswordNew.required'  => 'Nhập lại mật khẩu mới không được để trống',
            'txtRePasswordNew.same'  => 'Mật khẩu mới và nhập lại mật khẩu mới không trùng nhau'
        ];
    }
}
