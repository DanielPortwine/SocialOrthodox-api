<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'website',
        'facebook',
        'lat',
        'long',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'parish_user');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
