<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParish;
use App\Models\Parish;
use Illuminate\Http\Request;

class ParishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Parish::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParish $request)
    {
        $parish = Parish::create($request->all());

        return response()->json($parish, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Parish $parish)
    {
        return response()->json($parish, 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
