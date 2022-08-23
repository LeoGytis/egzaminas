<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $dishes = Dish::all();
        $menus = Menu::all();

        return view('dish.index', ['dishes' => $dishes, 'menus' => $menus,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('dish.create', ['menus' => $menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dish = new Dish;
        $dish->name = $request->dish_name;
        $dish->description = $request->dish_description;

        // ========================== Photo file ==========================

        if ($request->file('dish_photo')) {

            $photo = $request->file('dish_photo');
            $ext = $photo->getClientOriginalExtension();  //get extention of the file
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME); //original file name

            $file = $name . '-' . rand(100, 111) . '.' . $ext;  //create new name for the file
            $photo->move(public_path() . '/images', $file); //move file from tmp

            $dish->photo = asset('/images') . '/' . $file; //read file path as url
        }

        $dish->menu_id = $request->menu_id;
        $dish->save();
        return redirect()->route('dish.index')->with('pop_message', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $menus = Menu::all();
        return view('dish.edit', ['dish' => $dish, 'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDishRequest  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $dish->name = $request->dish_name;
        $dish->description = $request->dish_description;

        // ========================== Photo file ==========================

        if ($request->file('dish_photo')) {

            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $ext = pathinfo($dish->photo, PATHINFO_EXTENSION);

            $path = asset('/images') . '/' . $name . '.' . $ext;

            if (file_exists($path)) {
                unlink($path);
            }

            $photo = $request->file('dish_photo');
            $ext = $photo->getClientOriginalExtension();  //get extention of the file
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME); //original file name

            $file = $name . '-' . rand(100, 999) . '.' . $ext;  //create new name for the file
            $photo->move(public_path() . '/images', $file); //move file from tmp

            $dish->photo = asset('/images') . '/' . $file; //read file path as url
        }

        $dish->menu_id = $request->menu_id;
        $dish->save();
        return redirect()->route('dish.index')->with('pop_message', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        if ($dish->photo) {

            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $ext = pathinfo($dish->photo, PATHINFO_EXTENSION);

            $path = public_path() . '/images/' . $name . '.' . $ext;

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $dish->delete();
        return redirect()->route('dish.index')->with('pop_message', 'Successfully deleted!');
    }
}
