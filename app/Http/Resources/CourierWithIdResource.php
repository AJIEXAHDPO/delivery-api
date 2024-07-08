<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierWithIdResource extends JsonResource
{
    /**
     * Курьер с ID.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'courier_type' => $this->courier_type,
            'regions' => json_decode($this->regions),
            'working_hours' => json_decode($this->working_hours),
        ];
    }
}
