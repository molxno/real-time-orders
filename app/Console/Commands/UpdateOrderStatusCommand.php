<?php

namespace App\Console\Commands;

use App\Events\OrderShipmentStatusUpdated;
use Illuminate\Console\Command;

class UpdateOrderStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:update-status {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of an order';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $status = $this->argument('status');

        if (!in_array($status, ['created', 'processing', 'shipped', 'delivered'])) {
            $this->error('Invalid status provided.');
            return;
        }

        $order = \App\Models\Order::first();

        $order->update(['status' => $status]);

        $this->info("Order status updated to: {$status}");

        OrderShipmentStatusUpdated::dispatch($order, $status);
    }
}
