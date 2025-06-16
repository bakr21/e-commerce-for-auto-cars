<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class SiteSetting extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['site_name', 'company_description', 'address'];
    protected $fillable = [
        'site_name',
        'site_image',
        'map_link',
        'phone_number',
        'company_description',
        'hotline',
        'address',
        'email',
        'facebook_link',
        'whatsapp_number',
        'twitter_link',
        'linkedin_link',
        'working_hours'
    ];
}
