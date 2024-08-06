<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index(): JsonResponse{
        $events = Event::paginate(5);

        return response()->json([
            "data"=> $events
        ]);
    }

    public function show(string $id): JsonResponse{
        if(!is_numeric($id)){
            return response()->json([
                "message"=> "Invalid ID supplied"
            ], 400);
        }

        $event = Event::findOrFail($id);

        $responseData = [
            "id" => $event->id,
            "title" => $event->title,
            "description" => $event->description,
            "location" => $event->location,
            "created_at" => $event->created_at,
            "updated_at" => $event->updated_at
        ];

        return response()->json([
            "data"=>$responseData
        ]);
    }

    public function store(Request $request): JsonResponse{
        $validatedData = $request->validate([
            "title"=> "required|string",
            "description"=> "string|nullable",
            "date"=> "required|date|after:today",
            "location"=> "required|string",
        ]);

        $event = Event::create($validatedData);

        return response()->json([
            "data"=> $event
        ]);
    }

    public function getEventRegistees(string $id): JsonResponse{
        if(!is_numeric($id)){
            return response()->json([
                "message"=> "Invalid ID supplied"
            ], 400);
        }

        $registees = Event::find($id)->registees;

        return response()->json([
            "data"=> $registees
        ]);
    }
}
