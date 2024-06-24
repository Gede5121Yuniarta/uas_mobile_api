<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_kost',
        'description',
        'location',
        'latitude',
        'longitude',
        'kost_type',
        'facilities',
        'rules',
        'media',
        'whatsapp_number',
        'status',
        'owner_id',
        'slug',
        'facebook',
        'instagram',
        'twitter',
        // 'social_media',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    // public function admin()
    // {
    //     return $this->belongsTo(User::class, 'id');
    // }

    public function admin()
    {
        return $this->belongsTo(User::class, 'owner_id');  // Menggunakan owner_id sebagai foreign key
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // // In your Kost model
    // public function getRouteKeyName()
    // {
    //     return 'name_kost';
    // }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($kost) {
            $kost->slug = Str::slug($kost->name_kost);
        });
    }
}