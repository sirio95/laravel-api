<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

Route::get('/v1/movie/all', [ApiController::class, 'get_all_movie_tag_genre']);