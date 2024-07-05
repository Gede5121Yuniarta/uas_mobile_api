<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'class_id',
        'rooms_name',
        'description',
        // 'facilities',
        // 'media',
        'rooms_media',
        'status', // Kolom status
        'slug',
        'jumlah_kamar',
        'owner_id',
        'clicks',
    ];

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function roomClass()
    {
        return $this->belongsTo(RoomClass::class, 'class_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function getMediaAttribute($value)
    {
        return explode(',', $value);
    }

    // public function setMediaAttribute($value)
    // {
    //     $this->attributes['media'] = implode(',', $value);
    // }

    // public function setMediaAttribute($value)
    // {
    //     $files = [];
    //     foreach ($value as $file) {
    //         $files[] = Storage::putFile('public/media', $file);
    //     }
    //     $this->attributes['media'] = implode(',', $files);
    // }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($room) {
            $kostSlug = $room->kost->slug;
            $roomSlug = Str::slug($room->rooms_name);
            $room->slug = "{$kostSlug}-{$roomSlug}";
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');  // Menggunakan owner_id sebagai foreign key
    }

    // public static function getRoom(){
    //     $return = DB::table('rooms')
    //         ->join('kosts', 'rooms.kost_id', '=', 'kosts.id')
    //         ->join('room_classes', 'rooms.class_id', '=', 'class.id')
    //         ->select('rooms.*', 'kosts.*', 'room_classes.*')
    //         ->get();
    //     return $return;
    // }
    public static function getRoom(){
        $return = DB::table('rooms')
            ->join('kosts', 'rooms.kost_id', '=', 'kosts.id')
            ->join('room_classes', 'rooms.class_id', '=', 'room_classes.id')
            ->select('rooms.*', 'kosts.*', 'room_classes.*')
            ->get();
        return $return;
    }


}
