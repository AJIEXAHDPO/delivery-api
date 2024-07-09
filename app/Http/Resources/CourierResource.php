<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierResource extends JsonResource
{
    /**
     * Курьер без ID
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'courier_type' => $this->courier_type,
            'regions' => $this->regions,
            'working_hours' => $this->working_hours,
        ];
    }
}
