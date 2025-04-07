<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'adress',
        'phoneNumber',
        'discount',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
