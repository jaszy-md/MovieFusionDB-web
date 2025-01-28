<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = Genre::all()->pluck('id')->toArray();

        Movie::factory()->count(20)->create()->each(function ($movie) use ($genres) {
            $movie->genres()->attach(Arr::random($genres, rand(1, 3)));
        });
    }
}
