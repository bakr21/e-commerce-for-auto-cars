<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'short_description', 'description', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    public function category(){
        return $this->belongsTo(Category::class ,'category_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class ,'brand_id','id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function product_ratings() {
        return $this->hasMany(ProductRating::class)->where('status',1);
    }

    public function getAvgRatingAttribute()
    {
        return $this->product_ratings_count > 0
            ? round($this->product_ratings_sum_rating / $this->product_ratings_count, 2)
            : 0.00;
    }

    public function getAvgRatingPerAttribute()
    {
        return $this->avg_rating * 20; // تحويل التقييم لنسبة مئوية
    }



}
