<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:180',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nama tidak boleh kosong',
        ];
    }
}
