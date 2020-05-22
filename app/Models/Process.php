<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = "processes";

    public function user(){
        return $this->hasMany('App\User', 'id', 'user_id');
    }

    public function source(){
        return $this->hasMany('App\Models\Source', 'id', 'source_id');
    }

    public function coolant(){
        return $this->hasMany('App\Models\Coolant', 'id', 'coolant_id');
    }

    public function heater(){
        return $this->hasMany('App\Models\Heater', 'id', 'heater_id');
    }

    public function extractor(){
        return $this->hasMany('App\Models\Extractor', 'id', 'extractor_id');
    }
    public function extragent(){
        return $this->hasMany('App\Models\Extragent', 'id', 'extragent_id');
    }
}
