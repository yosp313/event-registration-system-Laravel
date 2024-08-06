<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegisteeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/events", [EventController::class, "index"]);
Route::post("/events", [EventController::class, "store"]);
Route::get("/events/{id}", [EventController::class, "show"]);
Route::get("/events/{id}/registees", [EventController::class, "getEventRegistees"]);

Route::post("/events/{id}/registees", [RegisteeController::class, "store"]);
Route::get("/events/{event_id}/registees/{registee_id}", [RegisteeController::class, "show"]);

Route::get("/hello", fn()=> "Hello World");
Route::get("/postman/csrf", fn() => csrf_token());
