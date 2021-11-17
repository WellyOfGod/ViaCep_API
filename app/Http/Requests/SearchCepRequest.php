<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchCepRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Autoriza a requisição de forma explicita!
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
            //Setando cep como requirido, string, com no minimo 8 e no máximo 9 caracteres.
            'cep' => 'required|string|min:8|max:9'
        ];
    }
}
