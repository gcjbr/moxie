<?php

namespace Database\Factories;

use App\Models\Medspa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MedspaFactory extends Factory
{
    protected $model = Medspa::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'email_address' => $this->faker->unique()->safeEmail(),
        ];
    }
}
