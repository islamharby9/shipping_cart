<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'item_id'=>$this->item_id,
            'name'=>$this->item->name,
            'description'=>$this->item->description,
            'price'=>$this->item->price,
            'quantity'=>$this->quantity
        ];
    }
}
