<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedspaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required', 'numeric'],
            'email_address' => ['required', 'email'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
