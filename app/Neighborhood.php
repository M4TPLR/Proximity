<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Neighborhood extends Model
{
    use SpatialTrait;

    protected $fillable = ['name', 'geometry'];

    protected $spatialFields = ['geometry'];

    public function addresses(){
        return $this->hasMany('App\Address');
    }

}
