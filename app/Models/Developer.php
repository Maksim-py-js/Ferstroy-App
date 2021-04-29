<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    public function advantages() {
        return $this->hasMany('App\Models\Advantage', 'developer_id');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment', 'developer_id');
    }
    public function years() {
        return $this->belongsTo('App\Models\Year', 'year_id');
    }
    public function residential_complexes() {
        return $this->hasMany('App\Models\ResidentialComplex', 'developer_id');
    }
    public function map_marker() {
        return $this->belongsTo('App\Models\MapMarker', 'marker_id');
    }
}
