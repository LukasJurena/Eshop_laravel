<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; 
      // Primární klíč
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','image', 'description', 'price', 'sku', 'in_stock'
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

}