<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'size', 'description', 'cover_image',
        'rooms', 'beds', 'bathrooms', 'price', 'address', 'latitude',
        'longitude', 'is_visible', 'is_sponsored', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class)->withPivot('start_date', 'end_date');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('property_id', 'service_id');
    }

    public static function slugGenerator($string)
    {
        $slug = Str::slug($string, '-');
        $original_slug = $slug;
        $c = 1;
        $property_exists = Property::where('slug', $slug)->first();
        while ($property_exists) {
            $slug = $original_slug . '-' . $c;
            $property_exists = Property::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }
}
