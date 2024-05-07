<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => 'string'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
