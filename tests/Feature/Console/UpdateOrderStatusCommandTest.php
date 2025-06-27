<?php

use App\Console\Commands\UpdateOrderStatusCommand;
use App\Events\OrderShipmentStatusUpdated;
use App\Models\Order;
use Illuminate\Support\Facades\Event;

test('command updates order status with valid status', function () {
    // Create an order
    $order = Order::factory()->create(['status' => 'created']);

    // Mock the event dispatcher
    Event::fake();

    // Run the command
    $this->artisan('order:update-status', ['status' => 'processing'])
         ->expectsOutput('Order status updated to: processing')
         ->assertSuccessful();

    // Assert the order status was updated
    $this->assertEquals('processing', $order->fresh()->status);

    // Assert the event was dispatched
    Event::assertDispatched(OrderShipmentStatusUpdated::class, function ($event) use ($order) {
        return $event->getOrder()->id === $order->id && $event->status === 'processing';
    });
});

test('command fails with invalid status', function () {
    // Run the command with an invalid status
    $this->artisan('order:update-status', ['status' => 'invalid'])
         ->expectsOutput('Invalid status provided.')
         ->assertSuccessful();
});

test('command handles all valid statuses', function () {
    // Create an order
    $order = Order::factory()->create(['status' => 'created']);

    // Test each valid status
    foreach (['created', 'processing', 'shipped', 'delivered'] as $status) {
        // Mock the event dispatcher
        Event::fake();

        // Run the command
        $this->artisan('order:update-status', ['status' => $status])
             ->expectsOutput("Order status updated to: {$status}")
             ->assertSuccessful();

        // Assert the order status was updated
        $this->assertEquals($status, $order->fresh()->status);

        // Assert the event was dispatched
        Event::assertDispatched(OrderShipmentStatusUpdated::class, function ($event) use ($order, $status) {
            return $event->getOrder()->id === $order->id && $event->status === $status;
        });
    }
});
