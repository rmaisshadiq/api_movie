<?php

use App\Http\Controllers\Api\MovieController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('api/movie/{imdbId}', [MovieController::class, 'getMovie']);