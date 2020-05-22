<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractorDetail extends Model
{
    protected $table = 'extractors_details';

    public function detail(){
        return $this->hasMany('App\Models\Detail', 'id', 'detail_id');
    }

    public function extractor(){
        return $this->hasMany('App\Models\Extractor', 'id', 'extractor_id');
    }
}
