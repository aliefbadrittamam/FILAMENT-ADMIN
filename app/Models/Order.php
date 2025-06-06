<?php
// 9. Model Order
// File: app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'order_number',
        'customer_id',
        'total_harga',
        'status_order',
        'catatan',
        'tanggal_order',
        'expired_at',
    ];

    protected $casts = [
        'tanggal_order' => 'date',
        'expired_at' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id_customer');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }

    public function getTotalItemsAttribute()
    {
        return $this->orderItems()->sum('total');
    }
}