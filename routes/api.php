<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StundentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', [StundentController::class, 'index']);
Route::post('students', [StundentController::class, 'store']);
Route::get('students/{id}', [StundentController::class, 'show']);
Route::get('students/{id}/edit', [StundentController::class, 'edit']);
Route::put('students/{id}/edit', [StundentController::class, 'update']);
Route::delete('students/{id}/delete', [StundentController::class, 'destroy']);