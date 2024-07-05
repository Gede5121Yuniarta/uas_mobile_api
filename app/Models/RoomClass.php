<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoomClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'kost_id',
        'owner_id',
        'classes_name',
        'facilities',
        'price',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    // // Accessor for formatted price
    // public function getFormattedPriceAttribute()
    // {
    //     return 'Rp' . number_format($this->price, 0, ',', '.');
    // }

    // public function setPriceAttribute($value)
    // {
    //     // Hapus semua karakter non-digit dari nilai harga
    //     $this->attributes['price'] = preg_replace('/[^0-9]/', '', $value);
    // }

    // Accessor untuk mengambil harga dengan format "Rp"
    public function getPriceAttribute($value)
    {
        // Format harga dengan "Rp" di depannya
        return 'Rp.' . number_format($value, 0, ',', '.');
        // return $value;
    }

    // Mutator
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(['Rp.', '.', ','], '', $value);
    }

    // Accessor untuk mendapatkan harga tanpa format untuk form edit
    public function getRawPriceAttribute()
    {
        // return $this->attributes['price'];
        return intval($this->attributes['price']);
    }

    // In RoomClass model
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');  // Menggunakan owner_id sebagai foreign key
    }

    public static function getRoomClass(){
        $return=DB::table('room_classes')
        ->join('kosts','room_classes.kost_id', '=', 'kosts.id')
        ->join('users','room_classes.owner_id', '=', 'users.id')
        ->select('room_classes.*', 'kosts.*', 'rooms.*')
        ->get();
        return $return;
    }
}
