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

        return redirect()->route('ingredients.index')->with('message', 'Created ingredient successful');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
