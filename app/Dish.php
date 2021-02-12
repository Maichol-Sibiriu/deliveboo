<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function restaurants(){
        return $this->belongsTo('App\Restaurant');
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
