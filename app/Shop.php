<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function products(){
        return $this->hasMany('App\Product');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
