<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\CompleteOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderAssignResource;
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
     * 
     * @param \App\Http\Requests\StoreOrderRequest $request
     * @return \Illuminate\Http\Response
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
     * Assign the specified order a courier id.
     * 
     * @param \App\Http\Requests\UpdateOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function assign(UpdateOrderRequest $request)
    {
        $courier = Courier::find($request->courier_id);
        $order = Order::where('completion_time', null)->find($request->order_id);
        if ($courier && $order) {
            $order->assign_time = now();
            $order->courier_id = $request->courier_id;
            $order->save();
            return response()->json(new OrderAssignResource($order), 200);
        }
        return response()->json(['message' => 'Bad request'], 400);
    }
 
    /**
     * Mark the specified order as completed.
     * 
     * @param \App\Http\Requests\CompleteOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function complete(CompleteOrderRequest $request)
    {
        $order = Order::where('completion_time', null)->where('assign_time', 'not', null)->first();
        $courier = Courier::where();
    }
}
