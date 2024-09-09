<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class);
    }

}
