<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kost_id',
        'room_id',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
