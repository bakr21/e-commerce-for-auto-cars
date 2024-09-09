<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharges extends Model
{
    protected $table = 'shipping_charges';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    use HasFactory;
}
