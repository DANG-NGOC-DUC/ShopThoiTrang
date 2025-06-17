<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
    ];

    // Mỗi giỏ hàng thuộc về 1 user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Một giỏ hàng có nhiều cart items
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
