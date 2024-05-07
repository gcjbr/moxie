<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string'],
            'description' => ['string'],
            'price' => ['integer'],
            'duration' => ['integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
