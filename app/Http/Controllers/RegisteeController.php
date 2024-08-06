<?php

namespace App\Http\Controllers;

use App\Models\Registee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisteeController extends Controller
{
    //
    public function store(Request $request, string $event_id): JsonResponse {
        $validatedData = $request->validate([
            "name"=> "required|string",
            "email"=> "required|email",
        ]);

        $validatedData["event_id"] = $event_id;

        $registee = Registee::create($validatedData);

        return response()->json([
            "data"=> $registee
        ]);
    }

    public function show(Request $request, string $event_id, string $registee_id): JsonResponse {
        $registee = Registee::where("event_id", $event_id)->findOrFail($registee_id);

        return response()->json([
            "data"=> $registee
        ]);
    }
}
