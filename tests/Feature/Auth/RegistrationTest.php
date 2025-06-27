<?php

use Livewire\Volt\Volt;

test('registration screen can be rendered', function () {
    // Skip this test if registration is disabled
    if (!env('ENABLE_REGISTRATION', true)) {
        $this->markTestSkipped('Registration is disabled.');
    }

    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    // Skip this test if registration is disabled
    if (!env('ENABLE_REGISTRATION', true)) {
        $this->markTestSkipped('Registration is disabled.');
    }

    $response = Volt::test('auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
