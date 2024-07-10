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
        $order = Order::where('complete_time', null)->find($request->order_id);
        if ($courier && $order) {
            $order->assign_time = now();
            $order->courier_id = $request->courier_id;
            $order->save();
            return response()->json(new OrderAssignResource($order), 200);
        }
        return response()->json(['message' => 'Order not found or already completed'], 404);
    }

    /**
     * Mark the specified order as completed.
     * 
     * @param \App\Http\Requests\CompleteOrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function complete(CompleteOrderRequest $request)
    {
        $courier = Courier::find($request->courier_id);
        $order = Order::where('complete_time', null)->find($request->order_id);
        if ($courier && $order) {
            if ($request->courier_id !== $order->courier_id || !$order->assign_time)
                return response()->json(['message' => 'Courier Ids doesn\'t matches or order is not assigned'], 422);

            if ($request->complete_time < $order->assign_time)
                return response()->json(['message' => 'Invalid complete time'], 422);

            $order->complete_time = $request->complete_time;
            $order->save();
            return response()->json(['order_id' => $order->id], 200);
        }
        return response()->json(['message' => 'Order not found or already completed'], 404);
    }
}
