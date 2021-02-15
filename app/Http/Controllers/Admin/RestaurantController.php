<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | max: 40 | unique:restaurants',
            'address' => 'required',
            'vat_num' => 'required | size: 13 | unique:restaurants',
            'phone' => 'required | max: 30 | unique:restaurants',
            'image_logo' => 'mimes:jpg, bmp, png'
        ]);
        $data = $request->all();
        
        // dd($data);
        $data['slug'] = Str::slug($data['name'], '-');
        $data['user_id'] = Auth::id();

        if (!empty($data['image_logo'])) {
            $data['image_logo'] = Storage::disk('public')->put('images', $data['image_logo']);
        }

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);
        $name = $newRestaurant->name;
        
        $saved = $newRestaurant->save();


        
        if($saved) {

            if (!empty($data['categories'])) {
                $newRestaurant->categories()->attach($data['categories']);
            }

            return redirect()->route('admin.home')->with('saved', $name);
        } else {
            return redirect()->route('admin.restaurants.create');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editRestaurant = Restaurant::find($id);
        $categories = Category::all();
        return view('admin.restaurants.edit', compact('editRestaurant', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required','max: 40', Rule::unique('restaurants')->ignore($id)],
            'address' => 'required',
            'vat_num' => ['required ',' size: 13 ', Rule::unique('restaurants')->ignore($id)],
            'phone' => ['required ',' max: 30 ', Rule::unique('restaurants')->ignore($id)],
            'image_logo' => 'mimes:jpg, bmp, png'
        ]);
        $data = $request->all();
        $oldRestaurant = Restaurant::find($id);

        
        //Controllo lo Slug
        if ($data['name'] != $oldRestaurant->name) {
            $data['slug'] = Str::slug($data['name'], '-');
        } else {
            $data['slug'] = $oldRestaurant->slug;
        }

        //Aggiungo lo User ID
        $data['user_id'] = Auth::id();

        //Controllo immagine
        if(!empty($data['image_logo'])) {
            if(!empty($oldRestaurant->image_logo)) {
                Storage::disk('public')->delete($oldRestaurant->image_logo);
            }
            $data['image_logo'] = Storage::disk('public')->put('images', $data['image_logo']);
        }

        //eseguiamo l'update sul DB
        $name = $oldRestaurant->name;
        $updated = $oldRestaurant->update($data);

        if($updated) {

            if (!empty($data['categories'])) {
                $oldRestaurant->categories()->sync($data['categories']);
            } else {
                $oldRestaurant->categories()->detach();
            }
            return redirect()->route('admin.home')->with('updated', $name);
        } else {
            return redirect()->route('admin.restaurants.create');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $name = $restaurant->name;
        $deleted = $restaurant->delete();

        if($deleted) {
            if(!empty($restaurant->image_logo)) {
                Storage::disk('public')->delete($restaurant->image_logo);
            }
            return redirect()->route('admin.home')->with('deleted', $name);
        }
    }
}
