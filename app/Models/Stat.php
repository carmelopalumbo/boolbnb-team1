<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = ['ip_address', 'property_id'];

    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
