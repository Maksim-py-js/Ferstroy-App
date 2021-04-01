<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    public function residential_complex() {
        return $this->belongsTo('App\Models\ResidentialComplex', 'residential_complex_id');
    }
}
