<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $primaryKey = '__pk';

    public function properties()
    {
        return $this->hasMany(Property::class, '_fk_location', '__pk');
    }
}
