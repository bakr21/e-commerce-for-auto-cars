<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function activeProducts()
    {
    return $this->hasMany(Product::class)->where('status', 1);
    }

}
