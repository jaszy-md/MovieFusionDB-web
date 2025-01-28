<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence(3),
            'release_year' => $this->faker->year(),
            'description'  => $this->faker->sentence(5),
            'image_url'    => $this->faker->imageUrl(),
        ];
    }
}
