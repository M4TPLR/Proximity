<?php

namespace App\Http\Resources;

use App\Neighborhood;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'update_at' => $this->updated_at,
            'firstLine' => $this->firstLine,
            'secondLine' => $this->secondLine,
            'country' => $this->country,
            'number' => $this->number,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'neighborhood' => new NeighborhoodResource(Neighborhood::find($this->neighborhood_id)),
        ];
    }
}
