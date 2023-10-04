<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Events\Registered;
 

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
        'mobile',
        'role',
        'bio',
        'facebook',
        'instagram',
        'twitter',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["Admin", "Assistant admin", "Artist", "Buyer"][$value],
        );
    }
    public function artworks()
    {
        return $this->hasMany(Artworks::class);
    }
}
