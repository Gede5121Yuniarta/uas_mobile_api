<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerVerification extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        // 'kost_name',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
