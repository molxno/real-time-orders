<?php

use App\Livewire\Dashboard\OrderDisplay;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

test('component can render with order', function () {
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
    Livewire::test(OrderDisplay::class)
        ->assertSee('Order Information')
        ->assertSee('Order #' . $order->id)
        ->assertSee($product->title)
        ->assertSee('Order Status');
});

test('component can render without order', function () {
    // Mock the Order model to return null for first()
    $this->mock(Order::class, function ($mock) {
        $mock->shouldReceive('with')->andReturnSelf();
        $mock->shouldReceive('first')->andReturn(null);
    });

    Livewire::test(OrderDisplay::class)
        ->assertSee('No orders found.');
});

test('component toggles invoice visibility', function () {
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
    $component = Livewire::test(OrderDisplay::class);

    // Initially, showInvoice should be false
    expect($component->instance()->showInvoice)->toBeFalse();

    // Toggle invoice visibility
    $component->call('toggleInvoice');

    // Now, showInvoice should be true
    expect($component->instance()->showInvoice)->toBeTrue();

    // Toggle again
    $component->call('toggleInvoice');

    // Now, showInvoice should be false again
    expect($component->instance()->showInvoice)->toBeFalse();
});
