<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'customer_products','user_id', 'product_id')->withPivot('quantity');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'order_products', 'order_id', 'product_id')->withPivot('quantity');
    }

}
