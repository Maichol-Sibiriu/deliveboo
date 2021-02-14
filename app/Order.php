<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'price_tot',
        'phone',
        'address',
    ];

    public function dishes(){
        return $this->belongsToMany('App\Dish');
    }
}
