<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PizzaListResource;
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
        $collections = Pizza::paginate(24);

        return PizzaListResource::collection($collections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
