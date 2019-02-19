<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddRequest extends FormRequest
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
            'txtEmail' => 'required|unique:admin,email|email',
            'txtPassword'  => 'required',
            'txtRePassword' => 'required|same:txtPassword',
            'txtName'    => 'required',
            'txtAvatar'  => 'image|mimes:png,jpg,jpeg'
        ];
    }
    public function messages ()
    {
        return [
            'txtEmail.required' => 'Email không được để trống',
            'txtEmail.unique'   => 'Email này đã được dùng! Vui lòng chọn email khác',
            'txtEmail.email'   => 'Email này không hợp lệ',
            'txtPassword.required'  => 'Mật khẩu không được để trống',
            'txtRePassword.required' => 'Không được để trống trường này',
            'txtRePassword.same'     =>  'Mật khẩu nhập lại không trùng khớp',
            'txtName.required'    => 'Tên không được để trống',
            'txtAvatar.image'    => 'File bạn chọn không phải là hình',
            'txtAvatar.mimes'    => 'Hình bạn chọn phải thuộc các định dạng: png, jpg, jpeg',
        ];
    }
}
