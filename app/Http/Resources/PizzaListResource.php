<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PizzaListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'ingredients'  => IngredientResource::collection($this->ingredients),
            'price'        => $this->price(),
            'date'         => $this->created_at->format('Y/m/d H:i:s'),
            'route_delete' => route('pizza.destroy', $this->id)
        ];
    }
}
