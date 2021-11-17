<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCepRequest;
use App\Models\Ceps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchCepController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(SearchCepRequest $request)
    {
        //Realiza a tratativa do dado passado via request
        $cep = preg_replace('/\D/','', $request->validated()['cep']);
        //Atribui a variável $response o objeto JSON já com suas devidas tratativas realizados na variável $cep
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/")->json();

        /*Condicional que verifica se no objeto JSON possui a key cep,
        se não possuir, significa que o valor passado não é válido,
        mostrando a mensagem de Cep inválido e
        status 404
        */
        if(!isset($response['cep']))
        {
            return response()->json(
                'Cep informado inválido!', 404
            );
        }

        //Faz a chamada do Model Ceps, criando portanto o registro no banco de dados
        return response()->json(
            Ceps::create($response)
        );
    }
}
