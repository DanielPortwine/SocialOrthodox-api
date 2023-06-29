<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function organiser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parish()
    {
        return $this->belongsTo(Parish::class, 'parish_id');
    }
}
