<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'subtotal',
        'shipping_cost',
        'tax',
        'total',
        'status',
        'payment_method',
        'transaction_id',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function generateOrderNumber()
    {
        $number = 'ORD-' . date('Ymd') . '-' . strtoupper(uniqid());
        return $number;
    }
}
