<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    // use HasApiTokens, 
    use notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'google_id',
        'api_token',
        'brand_name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verivied_at' => 'datetime',
        'type' => 'string',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function kosts()
    {
        return $this->hasMany(Kost::class, 'owner_id');
    }


    // protected function type() : Attribute
    // {
    //     return new Attribute(
    //         get: fn($value)=>["user", "admin", "super admin"][$value],
    //     );
    // }
}

