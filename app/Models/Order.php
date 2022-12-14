<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    const STATUSES = [
        1 => 'Pending',
        2 => 'Canceled',
        3 => 'Approved'
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
