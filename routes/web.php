<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Invoice routes
    Route::get('/invoice/{invoice}', function (\App\Models\Invoice $invoice) {
        $invoice->load(['order.user', 'order.products']);
        return view('invoice.show', compact('invoice'));
    })->name('invoice.show');
});

require __DIR__.'/auth.php';
