<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'txtName' => 'required',
            'txtEmail' => 'email',
//            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }
    public function messages ()
    {
        return [
            'txtName.required' => 'Bạn chưa nhập tên',
            'txtEmail.email'   => 'Email này không hợp lệ',
//            'g-recaptcha-response.required'   => 'Bạn chưa xác thực',
        ];
    }
}
