<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Area;
use App\User;

class ShopResource extends JsonResource
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
            'updated_at' => $this->updated_at,
            'name' => $this->name,
            'description' => $this->description,
            'imgurl' => $this->imgurl,
            'ShippingType' => $this->ShippingType,
            'area' => new AreaResource(Area::find($this->area_id)),
            'user_id' => new UserResource(User::find($this->user_id)),
        ];    }
}
