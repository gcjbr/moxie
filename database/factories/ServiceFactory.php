<?php

namespace Database\Factories;

use App\Models\Medspa;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'duration' => $this->faker->randomNumber(),
            'medspa_id' => Medspa::factory(),
        ];
    }
}
