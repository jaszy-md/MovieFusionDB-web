<?php

namespace App\Http\Resources\Genres;

use App\Http\Resources\Movies\MovieResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'movies' => MovieResource::collection($this->whenLoaded('movies')),
        ];
    }
}
