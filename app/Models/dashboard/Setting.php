<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'site_logo',
        'phone1',
        'phone2',
        'whatsapp',
        'email',
        'address',
        'google_map_link',
        'working_hours',
        'facebook',
        'instagram',
        'twitter',
        'tiktok',
        'youtube',
        'snapchat',
        'linkedin',
        'terms',
        'about_us',
    ];

    public static function getSettings()
    {
        $setting = self::first();
        if (!$setting) {
            $setting = self::create([]);
        }
        return $setting;
    }
}
