<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'discount_type',
        'discount_amount',
        'min_order_amount',
        'max_uses',
        'max_uses_user',
        'start_date',
        'end_date',
        'is_active',
        'created_by',
    ];

    // app/Models/DiscountCoupon.php
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

        public function isExpired()
    {
        return $this->end_date && now()->greaterThan($this->end_date);
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];



}
