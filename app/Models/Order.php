<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_amount', 'payment_method', 'status',
        'shipping_name', 'shipping_email', 'shipping_phone',
        'shipping_address', 'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'created_at'   => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        $map = [
            'pending'    => 'badge-pending',
            'processing' => 'badge-processing',
            'shipped'    => 'badge-processing',
            'completed'  => 'badge-completed',
            'cancelled'  => 'badge-cancelled',
        ];
        return $map[$this->status] ?? 'badge-pending';
    }
}
