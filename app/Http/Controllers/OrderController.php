<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Courier;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $orders = [];
        foreach ($request->data as $order) {
            $order = Order::create($order);
            array_push($orders, $order);
        }
        return response()->json(['orders' => OrderResource::collection($orders)], 201)->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function assign(UpdateOrderRequest $request)
    {
        $courier = Courier::find($request->courier_id);
        $order = Order::find($request->courier_id);
        if ($courier && $order) {
            $order->update([
                'assign_time' => date('m-d-Y h'),
                'courier_id' => ''
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
