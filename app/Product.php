<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'quantity', 'price', 'imgurl'];

    public function store(){
        return $this->belongsTo('App\Store');
    }

    protected $table = 'products';
}
