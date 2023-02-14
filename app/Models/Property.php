<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(Sponsor::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
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
