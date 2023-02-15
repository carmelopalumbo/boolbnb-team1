<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot('start_date', 'end_date');
    }
}
