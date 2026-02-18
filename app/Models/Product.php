<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'cat_id',
        'brand',
        'price',
        'discount_price',
        'image',
        'description',
    ];

    // Route model binding with slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relationship to category
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentage()
    {
        if (!$this->discount_price || $this->discount_price >= $this->price) {
            return 0;
        }
        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    /**
     * Check if product has discount
     */
    public function hasDiscount()
    {
        return $this->discount_price && $this->discount_price < $this->price;
    }

    /**
     * Get display price (returns discount price if available, otherwise regular price)
     */
    public function getDisplayPrice()
    {
        return $this->discount_price && $this->discount_price < $this->price ? $this->discount_price : $this->price;
    }
}

