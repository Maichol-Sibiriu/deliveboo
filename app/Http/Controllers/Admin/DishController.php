<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Dish;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $dishes = Dish::where('restaurant_id', $id)->get();
        return view('admin.dishes.index', compact('dishes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
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
            'name' => 'required | max:40',
            'price' => 'required | numeric | min:0 | max:999',
            'image' => 'image',
            'typology' => 'required | max:30',
        ]);

        $data = $request->all();
        $data['restaurant_id'] = Auth::user()->id;
        $data['price'] = (int)$data['price'];
        $data['available'] = !empty($data['available']) && $data['available'] == 'on' ? 1 : 0;
        $data['vegan'] = !empty($data['vegan']) && $data['vegan'] == 'on' ? 1 : 0;


        $newDish = new Dish();
        if(!empty($data['image'])) {
            $data['image'] = Storage::disk('public')->put('images/dish_images', $data['image']);
        } else {
            $data['image'] = null;
        }

        $newDish->fill($data);
        $saved = $newDish->save();

        if($saved) {
            $name = $data['name'];
            return redirect()->route('admin.dishes.index')->with('created', $name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::where('id' , $id)->first();

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::find($id);
        return view('admin.dishes.edit', compact('dish'));
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
            'name' => 'required | max:40',
            'price' => 'required | numeric | min:0 | max:999',
            'image' => 'image',
            'typology' => 'required | max:30',
        ]);
        
        $oldDish = Dish::find($id);

        $data = $request->all();
        $data['price'] = (int)$data['price'];
        $data['available'] = !empty($data['available']) && $data['available'] == 'on' ? 1 : 0;
        $data['vegan'] = !empty($data['vegan']) && $data['vegan'] == 'on' ? 1 : 0;


        if(empty($data['image'])) {
            if(!empty($oldDish->image)) {
                Storage::disk('public')->delete($oldDish->image);
                $data['image'] = null;
            }
        } else {
            $data['image'] = Storage::disk('public')->put('images/dish_images', $data['image']);
        }

        $name = $oldDish->name;
        $updated = $oldDish->update($data);

        if($updated) {
            return redirect()->route('admin.dishes.show', $id)->with('updated', $name);
        } else {
            return redirect()->route('admin.dishes.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $name = $dish->name;
        $deleted = $dish->delete();

        if($deleted) {
            if(!empty($dish->image)) {
                Storage::disk('public')->delete($dish->image);
            }
            return redirect()->route('admin.dishes.index')->with('deleted', $name);
        }
    }
}
