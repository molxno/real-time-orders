<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The products that belong to the order.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    /**
     * Get the invoice associated with the order.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Calculate the subtotal of the order.
     */
    public function calculateSubtotal()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }
}
