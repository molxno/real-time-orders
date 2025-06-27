<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
    ];

    /**
     * The orders that belong to the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
