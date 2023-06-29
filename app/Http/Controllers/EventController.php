<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::with(['organiser', 'parish'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvent $request)
    {
        $request->merge(['user_id' => Auth::id()]);

        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['organiser', 'parish']);

        return response()->json($event, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvent $request, string $id)
    {
        $event = Event::where('id', $id)->first();

        if (Auth::id() !== $event->user_id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $event->update($request->all());

        return response()->json($event, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::where('id', $id)->first();

        if (Auth::id() !== $event->user_id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $event->delete();

        return response()->json(['message' => 'Success.'], 204);
    }
}
