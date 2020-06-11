<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IngredientValidate;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the ingredients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $ingredients = Ingredient::orderBy('id', 'DESC')
            ->paginate(24);

        return view('admin.ingredient.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new ingredient.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $route = route('ingredients.store');
        $method = method_field('post');
        $item = null;

        return view('admin.ingredient.form', compact('route', 'method', 'item'));
    }

    /**
     * Store a newly created ingredient in storage.
     *
     * @param IngredientValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(IngredientValidate $request)
    {
        Ingredient::create($request->all());

        return redirect()->route('ingredients.index')
            ->with('message', 'Created ingredient successful')
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ingredient $ingredient
     * @return \Illuminate\View\View
     */
    public function edit(Ingredient $ingredient)
    {
        $route = route('ingredients.update', $ingredient->id);
        $method = method_field('put');
        $item = $ingredient;

        return view('admin.ingredient.form', compact('route', 'method', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param IngredientValidate $request
     * @param Ingredient $ingredient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(IngredientValidate $request, Ingredient $ingredient)
    {
        $ingredient->name = $request->get('name');
        $ingredient->cost_price = $request->get('cost_price');

        $ingredient->save();

        return redirect()->route('ingredients.index')
            ->with('message', 'Update ingredient successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ingredient $ingredient
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')
            ->with('message', 'Delete ingredient successful');
    }
}
