<?php

use App\Models\Appointment;
use App\Models\Medspa;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs($this->user);
});

it('fetches all appointments', function () {
    Appointment::factory()->count(3)->create();

    $response = $this->getJson('/api/v1/appointments');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

it('fetches appointments filtered by status', function () {
    Appointment::factory()->create(['status' => 'scheduled']);
    Appointment::factory()->create(['status' => 'canceled']);

    $response = $this->getJson('/api/v1/appointments?status=canceled');

    $response->assertStatus(200)
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.status', 'canceled');
});

it('fetches appointments filtered by start date', function () {
    $today = now()->toDateString();
    Appointment::factory()->create(['start_time' => now()]);
    Appointment::factory()->create(['start_time' => now()->addDay()]);

    $response = $this->getJson("/api/v1/appointments?start_date={$today}");

    $response->assertStatus(200)
        ->assertJsonCount(1, 'data');
});

it('creates an appointment with services', function () {
    $medspa = Medspa::factory()->create();
    $services = Service::factory()->count(2)->create();

    $totalDuration = $services->sum('duration');
    $totalPrice = $services->sum('price') / 100;


    $response = $this->postJson("/api/v1/medspas/$medspa->id/appointments", [
        'start_time' => '2025-05-06 01:43:02',
        'services' => $services->pluck('id')->toArray()
    ]);


    $response->assertStatus(201)
        ->assertJsonPath('data.status', 'scheduled')
        ->assertJsonPath('data.total_duration', $totalDuration)
        ->assertJsonPath('data.total_price', $totalPrice);
});


it('retrieves a specific appointment by its id', function () {

    $appointment = Appointment::factory()->create();

    $response = $this->getJson("/api/v1/appointments/{$appointment->id}");

    $response->assertStatus(200)
        ->assertJsonPath('data.id', $appointment->id);
});


it('allows an API consumer to update an appointment’s status', function () {
    $appointment = Appointment::factory()->create(['status' => 'scheduled']);

    $response = $this->patchJson("/api/v1/appointments/{$appointment->id}", [
        'status' => 'canceled'
    ]);

    
    $response->assertStatus(200)
        ->assertJsonPath('data.status', 'canceled');
});

