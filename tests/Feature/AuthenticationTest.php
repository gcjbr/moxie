<?php


use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('denies access to appointments for unauthenticated users', function () {
    $response = $this->getJson('/api/v1/appointments');
    $response->assertStatus(401);
});

it('allows access to appointments for authenticated users', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/v1/appointments');
    $response->assertStatus(200);
});
