<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'origin' => 'required|active_url',      // Длинный URL должен быть действующим
            'path' =>   'required|string|max:20|min:4|unique:urls,path', // Для коротко допустимо от 4 до 20 символов и уникальность в таблице
        ];
    }
}
