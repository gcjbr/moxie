<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'description' => ['required', 'nullable'],
            'price' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            'medspa_id' => ['required', 'exists:medspas,id'],

        ];
    }

    public function authorize()
    {
        return true;
    }
}
