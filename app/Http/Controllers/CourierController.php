<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourierRequest;
use App\Http\Resources\CourierResource;
use App\Http\Resources\CourierWithIdResource;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CourierResource::collection(Courier::all());
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
    public function store(StoreCourierRequest $request)
    {
        $couriers = [];
        foreach ($request as $item) {
            $courier = Courier::create([
                'courier_type' => $item->courier_type,
                'region' => $item->region,
                'working_hours' => $item->working_hours,
            ]);
            array_push($couriers, $courier);
        }
        return response()->json(['couriers'=> CourierWithIdResource::collection($couriers)], 201)->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $result = Courier::find($id);
        if ($result)
            return response()->json(new CourierWithIdResource($result))->header('Content-Type', 'application/json');
        else
            return response()->json(['message' => 'Not Fond'], 404)->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courier $courier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courier $courier)
    {
        //
    }
}
