<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = '__pk';

    public function property()
    {
        return $this->belongsTo(Property::class, '_fk_property', '__pk');
    }
}
