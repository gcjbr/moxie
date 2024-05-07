<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Medspa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'start_time' => Carbon::now(),

            'medspa_id' => Medspa::factory(),
        ];
    }
}
