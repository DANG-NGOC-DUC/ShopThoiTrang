<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Mỗi cart item thuộc về 1 giỏ hàng
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    // Mỗi cart item thuộc về 1 sản phẩm
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
