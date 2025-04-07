<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',   // Opraveno z users_id
        'product_id',
        'rating',
        'comment',
    ];

    // Vztah: recenze patří k jednomu uživateli (users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Vztah: recenze patří k jednomu produktu
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
