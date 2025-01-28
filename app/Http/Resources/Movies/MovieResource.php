<?php

namespace App\Http\Resources\Movies;

use App\Http\Resources\Genres\GenreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'id'           => $this->id,
            'title'        => $this->title,
            'release_year' => $this->release_year,
            'description'  => $this->description,
            'image_url'    => $this->image_url,
            'genres'       => GenreResource::collection($this->whenLoaded('genres')),
        ];
    }
}
