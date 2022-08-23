<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Dish;




class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = Menu::all();

        $restaurants = Restaurant::all();
        return view('menu.index', ['menus' => $menus, 'restaurants' => $restaurants,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // return view('menu.create');

        $restaurants = Restaurant::all();
        return view('menu.create', ['restaurants' => $restaurants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->name = $request->menu_name;
        $menu->restaurant_id = $request->restaurant_id;
        $menu->save();
        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(int $menuId)
    {
        $dishes = Dish::all();

        $menu = menu::where('id', '=', $menuId)->first();

        return view('menu.show', ['menu' => $menu, 'dishes' => $dishes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $restaurants = Restaurant::all();
        return view('menu.edit', ['menu' => $menu, 'restaurants' => $restaurants]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        // $restaurants = Restaurant::all();
        // return redirect()->route('menu.index')->with('pop_message', 'Successfully edited!');

        $menu->name = $request->menu_name;
        $menu->restaurant_id = $request->restaurant_id;
        $menu->save();
        return redirect()->route('menu.index')->with('pop_message', 'Successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if (!$menu->dishes->count()) {
            $menu->delete();
            return redirect()->route('menu.index')->with('pop_message', 'Successfully deleted!');
        }
        return redirect()->back()->with('pop_message', 'This menu can not be deleted!');
    }
}
