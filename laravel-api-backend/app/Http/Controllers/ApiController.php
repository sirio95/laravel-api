<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;

class ApiController extends Controller
{
    public function get_all_movie_tag_genre()
    {
        $movies = Movie::with('tags')
            ->orderBy('created_at', 'desc')
            ->get();
        $genres = Genre::all();
        $tags = Tag::all();

        return response()->json([
            'success' => true,
            'response' => [
                'movies' => $movies,
                'genres' => $genres,
                'tags' => $tags,
            ]
        ]);
    }
    public function movie_store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'director' => 'required|string|min:0',
            'prod_year' => 'required|integer|min:0',
            'expenses' => 'required|integer|min:0',
            'cashout' => 'required|integer|min:0',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'nullable|array',
        ]);

        $genre = Genre::find($data['genre_id']);
        $movie = Movie::make($data);

        $movie->genre()->associate($genre);
        $movie->save();

        if (array_key_exists('tags_id', $data)) {
            $tags = Tag::find($data['tags_id']);
            $movie->tags()->sync($tags);
        }

        return response()->json([
            'success' => true,
            'response' => $movie,
            'data' => $request->all()
        ]);
    }

    public function movie_update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'director' => 'required|string|min:0',
            'prod_year' => 'required|integer|min:0',
            'expenses' => 'required|integer|min:0',
            'cashout' => 'required|integer|min:0',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'nullable|array',
        ]);

        $genre = Genre::find($data['genre_id']);

        $movie->update($data);
        $movie->genre()->associate($genre);
        $movie->save();

        if (array_key_exists('tags_id', $data)) {
            $tag = Tag::find($data['tags_id']);
            $movie->tags()->sync($tag);
        }

        return response()->json([
            'success' => true,
            'response' => $movie,
            'data' => $request->all()
        ]);
    }

    public function movie_delete(Movie $movie)
    {
        $movie->tags()->sync([]);
        $movie->delete();

        return response()->json([
            'success' => true
        ]);
    }
}