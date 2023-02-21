<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

Route::get('/v1/movie/all', [ApiController::class, 'get_all_movie_tag_genre']);

Route::post('/v1/movie/store', [ApiController::class, 'movie_store']);

Route::post('/v1/movie/update/{movie}', [ApiController::class, 'movie_update']);

Route::delete('v1/movie/delete/{movie}', [ApiController::class, 'movie_delete']);