<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Restaurant;

class ApiController extends Controller
{
    public function filter_restaurant(Request $request) {
        $data = $request->all();
        $name = $data['name'];

        // niente filtri, invio tutti i ristoranti
        if ( empty($data['name']) && empty($data['categories']) ) {
            $restaurants = DB::table('restaurants')
                ->select('restaurants.id', 'restaurants.name','restaurants.image_logo', 'restaurants.slug')
                ->get();
        }
        // filtro con solo nome
        elseif ( ! empty($data['name']) && empty($data['categories'])) {
            $restaurants = Restaurant::where('name', 'like', "%$name%")
                ->select('restaurants.id', 'restaurants.name','restaurants.image_logo', 'restaurants.slug')
                ->get();
        }
        // filtro con sole categorie
        elseif ( empty($data['name']) && ! empty($data['categories'])) {
            $restaurants = [];

            // ciclo sulle categorie inviate, query a db per ogni categoria
            foreach ($data['categories'] as $category) {
                $results = DB::table('restaurants')
                    ->select('restaurants.id', 'restaurants.name','restaurants.image_logo', 'restaurants.slug' )
                    ->join('category_restaurant', 'restaurants.id', '=', 'category_restaurant.restaurant_id')
                    ->join('categories', 'categories.id', '=', 'category_restaurant.category_id')
                    ->where('categories.name', $category)
                    ->get();

                // ciclo sui risultati della query
                foreach ($results as $result) {
                    $verify = true;
                    // ciclo su array ristoranti per controllo unicità (l'elemento da pushare è già presente nell'array ristoranti?)
                    foreach ($restaurants as $restaurant) {
                        // se già inserito, setto $verify = false per controllo successivo
                        if ($restaurant->restaurant_id == $result->restaurant_id) {
                            $verify = false;
                        }
                    }
                    // push elemento nell'array ristoranti se supera il controllo unicità
                    if ($verify) {
                        $restaurants[] = $result;
                    }
                }
            }
        }
        // filtro completo, sia nome che categorie
        else {
            $restaurants = [];

            foreach ($data['categories'] as $category) {
                $results = DB::table('restaurants')
                    ->select('restaurants.id', 'restaurants.name','restaurants.image_logo', 'restaurants.slug')
                    ->join('category_restaurant', 'restaurants.id', '=', 'category_restaurant.restaurant_id')
                    ->join('categories', 'categories.id', '=', 'category_restaurant.category_id')
                    ->where('categories.name', $category)
                    ->where('restaurants.name', 'like', "%$name%")  // controllo aggiuntivo sul nome, rispetto alla query precedente
                    ->get();

                foreach ($results as $result) {
                    $verify = true;
                    foreach ($restaurants as $restaurant) {
                        if ($restaurant->restaurant_id == $result->restaurant_id) {
                            $verify = false;
                        }
                    }
                    if ($verify) {
                        $restaurants[] = $result;
                    }

                }
            }
        }

        // return JSON
        return response()->json($restaurants);
    }
}
