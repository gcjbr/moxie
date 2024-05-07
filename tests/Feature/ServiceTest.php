<?php

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

it('creates a service record', function () {
    $medspa = Medspa::factory()->create();

    $serviceData = [
        'name' => 'Deep Cleansing',
        'description' => 'A thorough cleaning service.',
        'price' => 10000, // Assuming price is in cents
        'duration' => 30, // Duration in minutes
        'medspa_id' => $medspa->id,
    ];

    $response = $this->postJson('/api/v1/services', $serviceData);

    $response->assertStatus(201)
        ->assertJsonPath('data.name', 'Deep Cleansing')
        ->assertJsonPath('data.medspa_id', $medspa->id);
});

it('retrieves a service by its id', function () {

    $medspa = Medspa::factory()->create();

    $service = Service::factory()->create(['medspa_id' => $medspa->id]);

    $response = $this->getJson("/api/v1/services/{$service->id}");

    $response->assertStatus(200)
        ->assertJsonPath('data.id', $service->id)
        ->assertJsonPath('data.name', $service->name);
});

it('updates a service record', function () {
    $medspa = Medspa::factory()->create();
    $service = Service::factory()->create(['medspa_id' => $medspa->id]);

    $updateData = [
        'name' => 'Advanced Peeling',
        'description' => 'An advanced skin peeling service.',
        'price' => 15000,
        'duration' => 45,
    ];

    $response = $this->putJson("/api/v1/services/{$service->id}", $updateData);

    $response->assertStatus(200)
        ->assertJsonPath('data.name', 'Advanced Peeling')
        ->assertJsonPath('data.price', 15000);
});

it('retrieves a list of all services for a given medspa', function () {
    $medspa = Medspa::factory()->create();
    Service::factory()->create(['medspa_id' => $medspa->id, 'name' => 'Facial']);
    Service::factory()->create(['medspa_id' => $medspa->id, 'name' => 'Massage']);

    $response = $this->getJson("/api/v1/medspas/{$medspa->id}/services");

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
});
