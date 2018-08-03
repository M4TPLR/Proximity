<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function area(){
        return $this->belongsTo('App\Area');
    }
}
