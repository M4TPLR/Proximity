<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'quantity', 'price', 'imgurl'];

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    protected $table = 'products';
}
