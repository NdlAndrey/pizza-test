<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'ingredient_id' => $this->id,
            'sort' => $this->whenPivotLoaded('pizza_ingredients', function () {
                return $this->pivot->sort;
            })
        ];
    }
}
