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
        return $this->hasMany('App\Models\Year', 'developer_id');
    }
}
