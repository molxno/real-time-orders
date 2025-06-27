<?php

namespace Tests\Feature\Events;

use App\Events\OrderShipmentStatusUpdated;
use App\Models\Order;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderShipmentStatusUpdatedTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_broadcasts_on_the_correct_channel(): void
    {
        $order = Order::factory()->create(['status' => 'processing']);
        $event = new OrderShipmentStatusUpdated($order);

        $this->assertInstanceOf(PrivateChannel::class, $event->broadcastOn());
        $this->assertEquals('private-orders.' . $order->id, $event->broadcastOn()->name);
    }

    public function test_event_uses_provided_status(): void
    {
        $order = Order::factory()->create(['status' => 'processing']);
        $event = new OrderShipmentStatusUpdated($order, 'shipped');

        $this->assertEquals('shipped', $event->status);
    }

    public function test_event_uses_order_status_when_no_status_provided(): void
    {
        $order = Order::factory()->create(['status' => 'processing']);
        $event = new OrderShipmentStatusUpdated($order);

        $this->assertEquals('processing', $event->status);
    }
}
