<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    public function floor_hovers() {
        return $this->hasMany('App\Models\FloorHover', 'floor_id');
    }
    public function appartments() {
        return $this->hasMany('App\Models\Appartment', 'floor_id');
    }
}
