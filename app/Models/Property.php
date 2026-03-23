<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'user_id', 
        'city_id', 
        'title', 
        'type', 
        'price', 
        'surface', 
        'rooms', 
        'furnished', 
        'status', 
        'views_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
