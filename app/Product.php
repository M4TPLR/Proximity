<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'quantity', 'price', 'imgurl'];

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    protected $table = 'products';

    protected $dates = ['deleted_at'];
}
