<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name'];

    /**
     * Relation with ingredients
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'pizza_ingredients', 'pizza_id', 'ingredient_id')
            ->withPivot('sort');
    }

    /**
     * Calculate price
     *
     * @return float|int
     */
    public function price()
    {
        $cost = $this->ingredients->sum('cost_price');
        return $cost + (config('app.percentage') / 100) * $cost;
    }
}
