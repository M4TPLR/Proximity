<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Shop;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'imgurl' => $this->imgurl,
            'shop' => new ShopResource(Shop::find($this->shop_id)),
        ];    }
}
