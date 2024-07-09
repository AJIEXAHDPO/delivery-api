<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourierRequest;
use App\Http\Requests\UpdateCourierRequest;
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
     * Store a new couriers.
     * 
     * @param \App\Http\Requests\StoreCourierRequest $request
     */
    public function store(StoreCourierRequest $request)
    {
        $couriers = [];
        foreach ($request->data as $item) {
            $courier = Courier::create([
                'courier_type' => $item['courier_type'],
                'regions' => $item['regions'],
                'working_hours' => $item['working_hours'],
            ]);
            array_push($couriers, $courier);
        }
        return response()->json(['couriers' => CourierWithIdResource::collection($couriers)], 201)->header('Content-Type', 'application/json');
    }

    /**
     * Display courier by id.
     * 
     * @param int $id
     */
    public function show(int $id)
    {
        return response()->json(new CourierWithIdResource(Courier::findOrFail($id)))->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courier $courier)
    {
        //
    }

    /**
     * Update courier by id.
     * 
     * @param \App\Http\Requests\UpdateCourierRequest $request
     * 
     * @param int $id
     */
    public function update(UpdateCourierRequest $request, int $id)
    {
        $courier = Courier::findOrFail($id);
        $courier->update($request->all());

        return new CourierWithIdResource($courier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courier $courier)
    {
        //
    }
}
