<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEditRequest extends FormRequest
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
            'txtRePasswordNew' => 'same:txtPasswordNew',
            'txtAvatar'  => 'image|mimes:png,jpg,jpeg'
        ];
    }
    public function messages ()
    {
        return [
            'txtRePasswordNew.same'     =>  'Mật khẩu nhập lại không trùng khớp',
            'txtAvatar.image'    => 'File bạn chọn không phải là hình',
            'txtAvatar.mimes'    => 'Hình bạn chọn phải thuộc các định dạng: png, jpg, jpeg',
        ];
    }
}
