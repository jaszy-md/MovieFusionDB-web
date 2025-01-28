<?php

namespace App\Http\Controllers\Api\Movies;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Movies\MovieResource;
use App\Http\Requests\Movies\StoreMovieRequest;
use App\Http\Requests\Movies\UpdateMovieRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $query = Movie::query()->with('genres');

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('genre_ids')) {
            $genreIds = $request->input('genre_ids');
            $query->whereHas('genres', function ($q) use ($genreIds) {
                $q->whereIn('id', $genreIds);
            });
        }

        $movies = $query->get();

        return MovieResource::collection($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $movie = Movie::create($validated);

        if ($request->has('genre_ids')) {
            $movie->genres()->sync($request->input('genre_ids'));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Movie successfully created',
            'data'    => new MovieResource($movie->load('genres')),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie->load('genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
    {
        $validated = $request->validated();

        $movie->update($validated);

        if ($request->has('genre_ids')) {
            $movie->genres()->sync($request->input('genre_ids'));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Movie successfully updated',
            'data'    => new MovieResource($movie->load('genres')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Movie successfully deleted',
        ]);
    }
}
