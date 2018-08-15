<?php

namespace App;

use bar\baz\source_with_namespace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Address extends Model
{
    use SoftDeletes;

    public function neighborhood(){
        return $this->belongsTo('App\Neighborhood');
    }

    public function shop(){
        return $this->belongsTo('App\Shop');
    }
}
