<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

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
        'private',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'email',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // global scope for private users
//    protected static function booted()
//    {
//        static::addGlobalScope('private', function ($query) {
//            $query->where('private', false)
//                ->orWhere('id', Auth::id());
//        });
//    }

    public function parishes()
    {
        return $this->belongsToMany(Parish::class);
    }

    public function managedParishes()
    {
        return $this->hasMany(Parish::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
