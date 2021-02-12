<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function dishes(){
        return $this->hasMany('App\Dish');
    }
}
