<?php

namespace App\Http\Requests\Movies;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'release_year' => ['required', 'integer'],
            'image_url'    => ['required', 'url'],
            'genre_ids'    => ['required', 'array'],
            'genre_ids.*'  => ['exists:genres,id'],
        ];
    }
}
