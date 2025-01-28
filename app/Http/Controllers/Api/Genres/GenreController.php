<?php

namespace App\Http\Controllers\Api\Genres;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Genres\GenreResource;
use App\Http\Requests\Genres\StoreGenreRequest;
use App\Http\Requests\Genres\UpdateGenreRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $genres = Genre::with('movies')->get();

        return GenreResource::collection($genres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $genre = Genre::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Genre successfully created',
            'data'    => new GenreResource($genre),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): GenreResource
    {
        return new GenreResource($genre->load('movies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre): JsonResponse
    {
        $validated = $request->validated();

        $genre->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Genre successfully updated',
            'data'    => new GenreResource($genre),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): JsonResponse
    {
        $genre->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Genre successfully deleted',
        ]);
    }
}
