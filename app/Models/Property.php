<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $primaryKey = '__pk';

    public function location()
    {
        return $this->belongsTo(Location::class, '_fk_location', '__pk');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, '_fk_property', '__pk');
    }
}
