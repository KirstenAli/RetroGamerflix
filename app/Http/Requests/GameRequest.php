<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'integer',
            'title' => 'required|string',
            'genre' => 'required|string',
            'description' => 'required|string',
            'thumbnail' => 'image|max:5120',
            'rom' => 'file|mimes:gb|max:5120'
        ];
    }
}
