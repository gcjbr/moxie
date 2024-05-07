<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
            'start_time' => 'required|date|after:today',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
