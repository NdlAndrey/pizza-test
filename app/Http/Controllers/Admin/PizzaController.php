<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PizzaValidate;
use App\Http\Resources\PizzaListResource;
use App\Models\Ingredient;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PizzaController extends Controller
{
    /**
     * Display a listing of the pizza.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pizza.index');
    }

    /**
     * Method return list pizza
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getPizza(Request $request)
    {
        $collections = Pizza::with('ingredients')
            ->paginate(24);

        $additional['ingredients'] = Ingredient::pluck('name', 'id');

        return PizzaListResource::collection($collections)->additional($additional);
    }

    /**
     * Store a newly created pizza in storage.
     *
     * @param PizzaValidate $request
     * @return PizzaListResource
     */
    public function store(PizzaValidate $request)
    {
        $pizza = Pizza::create($request->only('name'));

        $collect = collect($request->get('ingredients'));
        $pizza->ingredients()->sync($collect->keyBy('ingredient_id'));

        return new PizzaListResource($pizza);
    }

    /**
     * Update the specified pizza in storage.
     *
     * @param PizzaValidate $request
     * @param Pizza $pizza
     * @return PizzaListResource
     */
    public function update(PizzaValidate $request, Pizza $pizza)
    {
        $pizza->name = $request->get('name');
        $pizza->save();

        $collect = collect($request->get('ingredients'));
        $pizza->ingredients()->sync($collect->keyBy('ingredient_id'));

        return new PizzaListResource($pizza);
    }

    /**
     * Remove the specified pizza from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $code = Response::HTTP_UNPROCESSABLE_ENTITY;
        $pizza = Pizza::find($id);

        if ($pizza && $pizza->delete())
            $code = Response::HTTP_OK;

        return response()->json(['id' => $id], $code);
    }
}
