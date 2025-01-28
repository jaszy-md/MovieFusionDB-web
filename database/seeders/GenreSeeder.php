<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Action',
            'Comedy',
            'Drama',
            'Horror',
            'Roman',
            'Thriller',
        ];

        foreach ($genres as $genre) {
            Genre::updateOrCreate(
                ['name' => $genre]
            );
        }
    }
}
