<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'address',
        'password',
        'role_id',
    ];

    // Ẩn các thuộc tính khi serialize (ví dụ trả về JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Quan hệ: 1 User thuộc về 1 Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Quan hệ: 1 User có nhiều Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
