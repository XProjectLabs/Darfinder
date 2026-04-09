<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'user_id', 
        'city_id', 
        'category_id',
        'title', 
        'address',
        'type', 
        'price', 
        'surface', 
        'rooms', 
        'furnished', 
        'status', 
        'views_count',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
