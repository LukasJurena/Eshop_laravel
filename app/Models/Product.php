<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'sku', 'in_stock', 'images', 'category_id'
    ];
    
    protected $casts = [
        'images' => 'array', // Automatická konverze JSON na PHP pole
    ];

    /**
     * Define the relationship between Product and ProductImage.
     */

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
