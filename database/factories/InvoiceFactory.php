<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10, 500);
        $tax = $subtotal * 0.08; // 8% tax
        $total = $subtotal + $tax;

        return [
            'order_id' => Order::factory(),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ];
    }
}
