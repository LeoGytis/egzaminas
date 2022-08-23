<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public function dishMenu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }


    public function menuDishes()
   {
       return $this->hasMany('App\Models\Dish', 'menu_id', 'id');
   }

   public function orders()
   {
       return $this->hasMany(Order::class, 'dish_id', 'id');
   }
}
