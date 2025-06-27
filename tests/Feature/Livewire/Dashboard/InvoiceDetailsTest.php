<?php

use App\Livewire\Dashboard\InvoiceDetails;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

test('component can render with invoice', function () {
    // Create a user
    $user = User::factory()->create();

    // Create an order with products
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => 'processing'
    ]);

    // Create products and attach to order
    $product = Product::factory()->create();
    $order->products()->attach($product, [
        'quantity' => 2,
        'price' => 19.99
    ]);

    // Create an invoice for the order
    $invoice = Invoice::factory()->create([
        'order_id' => $order->id,
        'subtotal' => 39.98,
        'tax' => 3.20,
        'total' => 43.18
    ]);

    // Test the component
    Livewire::test(InvoiceDetails::class, ['invoice' => $invoice])
        ->assertSee('Invoice Details')
        ->assertSee($invoice->id)
        ->assertSee($product->title)
        ->assertSee('$39.98') // Subtotal
        ->assertSee('$3.20')  // Tax
        ->assertSee('$43.18'); // Total
});

test('component can render without invoice', function () {
    Livewire::test(InvoiceDetails::class)
        ->assertSee('No invoice found for this order.');
});

test('component mounts with invoice', function () {
    // Create a user
    $user = User::factory()->create();

    // Create an order with products
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => 'processing'
    ]);

    // Create an invoice for the order
    $invoice = Invoice::factory()->create([
        'order_id' => $order->id,
        'subtotal' => 39.98,
        'tax' => 3.20,
        'total' => 43.18
    ]);

    // Test the component
    $component = Livewire::test(InvoiceDetails::class, ['invoice' => $invoice]);

    // Assert the invoice is set correctly
    expect($component->instance()->invoice->id)->toBe($invoice->id);
});
