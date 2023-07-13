<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start',
        'end',
        'parish_id',
        'location',
        'lat',
        'long',
        'website',
        'capacity',
        'registration_start',
        'registration_end',
        'registration_link',
        'price',
        'visibility',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope('public', function ($query) {
            $query->where('visibility', 'public')
                ->orWhere('user_id', Auth::guard('sanctum')->id());
        });
    }

    public function scopeLink($query)
    {
        return $query->where('visibility', 'link')
            ->orWhere('visibility', 'public')
            ->orWhere('user_id', Auth::guard('sanctum')->id());
    }

    public function organiser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class, 'parish_id');
    }
}
