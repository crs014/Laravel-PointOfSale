<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product[]' => 'required',
            'price[]' => 'required|min:1',
            'quantity[]' => 'required|min:1'
        ];
    }
}
