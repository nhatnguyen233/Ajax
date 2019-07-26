<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSanPham extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:32|',
            // 'anh' => 'required|min:2|max:128|',
            'tomtat' => 'required|min:2|max:500|',
            'danhgia' => 'required|min:1|max:2'
        ];
    }
}
