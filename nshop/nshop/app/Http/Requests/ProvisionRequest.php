<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvisionRequest extends FormRequest
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
            'txtContent1' => 'required',
            'txtContent2' => 'required',
            'txtContent3' => 'required',
            'txtContent4' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'txtContent1.required' => 'Không được để trống',
            'txtContent2.required'  => 'Không được để trống',
            'txtContent3.required'  => 'Không được để trống',
            'txtContent4.required'  => 'Không được để trống'
        ];
    }
}
