<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;

class ApiController extends Controller
{
    public function filter_restaurant(Request $request) {
        $data = $request->all();
        dd($request);
        // if() {

        // }
        // // $restaurant = Restaurant::all();
        // // return response ()->json($restaurant);
    }
}
