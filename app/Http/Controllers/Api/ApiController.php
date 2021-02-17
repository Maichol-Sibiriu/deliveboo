<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function filter_restaurant(Request $request) {
        $data = $request->all();
        $name = $data['name'];
        
        if ( empty($data['name']) && empty($data['categories']) ) {
            $restaurants = Restaurant::all();
        }
        elseif ( ! empty($data['name']) && empty($data['categories'])) {
            $restaurants = Restaurant::where('name', 'like', "%$name%")->get();
        }
        elseif ( empty($data['name']) && ! empty($data['categories'])) {
            
            $restaurants = [];

            foreach ($data['categories'] as $category) {
                
                $queries = DB::table('restaurants')
                               ->join('category_restaurant', 'restaurants.id', '=', 'category_restaurant.restaurant_id')
                               ->join('categories', 'categories.id', '=', 'category_restaurant.category_id')
                               ->where('categories.name', $category)
                               ->get();

                foreach ($queries as $query) {

                    $verify = true;

                    foreach ($restaurants as $restaurant) {
                        
                        if ($restaurant->restaurant_id == $query->restaurant_id) {
                             
                            $verify = false;
                        }
                    }
                    
                    if ($verify) {
                        $restaurants[] = $query;
                    }

                }
            }
        }
        else {
            $restaurants = Restaurant::where('name', 'like', "%$name%")->get();
        }
        
        return response()->json($restaurants);
    }
}
