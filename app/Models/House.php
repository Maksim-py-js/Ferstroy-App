<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    public function house_hovers() {
        return $this->hasMany('App\Models\HouseHover', 'house_id');
    }
    public function house_floor_descriptions() {
        return $this->hasMany('App\Models\HouseFloorDescription', 'house_id');
    }
    public function house_navigations() {
        return $this->hasMany('App\Models\HouseNavigation', 'house_id');
    }
    public function floors() {
        return $this->hasMany('App\Models\Floor', 'house_id');
    }
}
