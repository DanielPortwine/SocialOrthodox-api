<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParish;
use App\Http\Requests\UpdateParish;
use App\Models\Parish;
use Illuminate\Support\Facades\Auth;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreParish $request)
    {
        $request->merge(['user_id' => Auth::id()]);

        $parish = Parish::create($request->all());

        return response()->json($parish, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Parish $parish)
    {
        $parish->load(['members', 'manager']);
        return response()->json($parish, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParish $request, int $id)
    {
        $parish = Parish::where('id', $id)->first();

        if (Auth::id() !== $parish->user_id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $parish->update($request->all());

        return response()->json($parish, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $parish = Parish::where('id', $id)->first();

        if (Auth::id() !== $parish->user_id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($parish) {
            $parish->delete();
            return response()->json(null, 204);
        }
    }
}
