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
}

