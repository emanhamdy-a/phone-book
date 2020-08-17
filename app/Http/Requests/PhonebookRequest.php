<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PhonebookRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            'name' => 'required|max:255|min:3',
            // 'phone' => 'required|numeric|between:9,11',
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/',
            'email'=> 'required|email|unique:phonebooks,email,'.$request->id
        ];
    }
}
