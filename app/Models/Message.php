<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'email', 'object', 'property_id'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
