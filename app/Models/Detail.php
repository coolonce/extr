<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'details';
    public $timestamps = false;

    public function type(){
        return $this->hasMany('App\Models\TypeOfDetails', 'id', 'type_id');
    }
}
