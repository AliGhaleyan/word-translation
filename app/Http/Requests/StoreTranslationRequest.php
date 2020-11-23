<?php

namespace App\Http\Requests;

use App\Entities\Word;
use Illuminate\Foundation\Http\FormRequest;

class StoreTranslationRequest extends FormRequest
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
            "word_id"     => "required|integer|exists:" . Word::class . ",id",
            "title"       => "required|string",
            "part_speech" => "required|string",
        ];
    }
}
