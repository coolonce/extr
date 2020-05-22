<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $table = 'passport';

    public function detail(){
        return $this->hasMany('App\Models\Detail', 'id', 'det_id');
    }

    public function charact(){
        return $this->hasMany('App\Models\Charact', 'id', 'ch_id');
    }

}

