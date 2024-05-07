<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('returns a token on valid login', function () {
    User::factory()->create([
        'email' => 'user@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->postJson('/api/v1/login', [
        'email' => 'user@example.com',
        'password' => 'password',
    ]);

    $response->assertOk();
    $response->assertJsonStructure(['token']);
});

it('denies access to appointments for unauthenticated users', function () {
    $response = $this->getJson('/api/v1/user');
    $response->assertStatus(401);
});

it('allows access to appointments for authenticated users', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/v1/user');
    $response->assertStatus(200);
});
