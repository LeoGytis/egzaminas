<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OrderStatus;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('order.index', ['orders' => $orders, 'statuses' => Order::STATUSES ]);
    }

    public function add(Request $request)
    {
        $order = new Order;

        $order->count = $request->dish_count;
        $order->dish_id = $request->dish_id;
        $order->user_id = Auth::user()->id;
        $order->save();

        return redirect()->route('order.show');
    }

    public function showMyOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('order.index', ['orders' => $orders, 'statuses' => Order::STATUSES]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')->with('pop_message', 'Successfully deleted!');
    }

    public function setStatus(Request $request, Order $order)
    {
        $order->status = $request->status;

        // Notification::send(Auth::user()->id, 'Your order status has been changed to');
        // Notification::sendNow(Auth::user()->email, 'Your order status has been changed to' . $request->status);

        $order->save();
        return redirect()->back()->with('pop_message', 'Order status has been changed.');
    }
}