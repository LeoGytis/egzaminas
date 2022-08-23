<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Dish;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurants = Restaurant::all();

        if ($request->search) {
            $restaurants = Restaurant::where('restaurants.name', 'like', '%' . $request->search . '%')->get();
        }

        return view('restaurant.index', ['restaurants' => $restaurants, 'search' => $request->search ?? '',]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = new Restaurant;
        $restaurant->name = $request->restaurant_name;
        $restaurant->code = $request->restaurant_code;
        $restaurant->address = $request->restaurant_address;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('pop_message', 'Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(int $restaurantId)
    {
        $menus = Menu::all();
        $dishes = Dish::all();

        $restaurant = Restaurant::where('id', '=', $restaurantId)->first();  //uzklausa grazina viena rezultata

        return view('restaurant.show', ['restaurant' => $restaurant, 'menus' => $menus, 'dishes' => $dishes,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurant.edit', ['restaurant' => $restaurant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)

    {
        $restaurant->name = $request->restaurant_name;
        $restaurant->code = $request->restaurant_code;
        $restaurant->address = $request->restaurant_address;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('pop_message', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if (!$restaurant->menus->count()) {
            $restaurant->delete();
            return redirect()->route('restaurant.index')->with('pop_message', 'Successfully deleted!');
        }
        return redirect()->back()->with('pop_message', 'This restaurant can not be deleted!');
    }
}
