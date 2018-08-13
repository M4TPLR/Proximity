<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function neighborhood(){
        return $this->belongsTo('App\Neighborhood');
    }
}
