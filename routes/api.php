<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Genres\GenreController;
use App\Http\Controllers\Api\Movies\MovieController;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

Route::middleware(CheckClientCredentials::class)->group(function () {
    Route::apiResource('movies', MovieController::class);
    Route::apiResource('genres', GenreController::class);
});
