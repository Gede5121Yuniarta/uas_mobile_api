<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'kost_id',
        'classes_name',
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

    public function setPriceAttribute($value)
    {
        // Hapus semua karakter non-digit dari nilai harga
        $this->attributes['price'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Accessor untuk mengambil harga dengan format "Rp"
    public function getPriceAttribute($value)
    {
        // Format harga dengan "Rp" di depannya
        return 'Rp' . number_format($value, 0, ',', '.');
    }

    // In RoomClass model
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}
