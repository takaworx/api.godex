<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * append the custom attributes below
     */
    protected $appends = [
        '_likes',
        '_dislikes',
        '_favorites',
    ];

    /**
     * Mutate the password on save
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getLikesAttribute()
    {
        $likes = $this->likes()->get();

        if (is_null($likes)) {
            return [];
        }

        return $likes->pluck('pokemon_id');
    }

    public function getDislikesAttribute()
    {
        $dislikes = $this->dislikes()->get();

        if (is_null($dislikes)) {
            return [];
        }

        return $dislikes->pluck('pokemon_id');
    }

    public function getFavoritesAttribute()
    {
        $favorites = $this->favorites()->get();

        if (is_null($favorites)) {
            return [];
        }

        return $favorites->pluck('pokemon_id');
    }
}
