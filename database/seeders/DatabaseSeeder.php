<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
            'address' => '123 Main St, City, Country',
        ]);

        // Create products
        $products = [
            [
                'title' => 'Laptop',
                'description' => 'High-performance laptop with the latest processor',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80',
                'price' => 1200.00,
            ],
            [
                'title' => 'Smartphone',
                'description' => 'Latest smartphone with advanced camera features',
                'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2027&q=80',
                'price' => 800.00,
            ],
            [
                'title' => 'Headphones',
                'description' => 'Noise-cancelling wireless headphones',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80',
                'price' => 150.00,
            ],
            [
                'title' => 'Tablet',
                'description' => 'Lightweight tablet with high-resolution display',
                'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80',
                'price' => 500.00,
            ],
            [
                'title' => 'Smartwatch',
                'description' => 'Fitness tracking smartwatch with heart rate monitor',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1399&q=80',
                'price' => 250.00,
            ],
        ];

        foreach ($products as $productData) {
            \App\Models\Product::create($productData);
        }

        // Create an order with products
        $order = Order::create([
            'user_id' => 1,
            'status' => 'created',
        ]);

        // Attach products to the order
        $order->products()->attach(1, ['quantity' => 1, 'price' => 1200.00]);
        $order->products()->attach(3, ['quantity' => 2, 'price' => 150.00]);

        // Calculate subtotal
        $subtotal = $order->calculateSubtotal();
        $tax = $subtotal * 0.16; // 16% tax
        $total = $subtotal + $tax;

        // Create invoice for the order
        \App\Models\Invoice::create([
            'order_id' => $order->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ]);
    }
}
