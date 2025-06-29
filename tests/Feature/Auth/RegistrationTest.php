<?php

use Illuminate\Support\Str;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'title' => 'Mr',
        'name' => 'Test User',
        'slug' => Str::slug('Test User'), // Optional: see note below
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 3
    ]);

    $response->assertRedirect(route('dashboard', absolute: false));
    $this->assertAuthenticated();
});