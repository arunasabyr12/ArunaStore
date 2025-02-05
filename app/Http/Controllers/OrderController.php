<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|100',
            'email' => 'required|email',
            'phone' => 'required|string',
            'items' => 'required|array'
        ]);

        $order = Order::create($validated);
        
        return response()->json(['messgae' => 'order praced!', 'order' => $order], 201);

    }

    public function index (Request $request)
    {
        return response()->json(Order::all());
    }
}
