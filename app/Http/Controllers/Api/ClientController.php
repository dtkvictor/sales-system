<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Validator;
use App\Rules\CpfValidate;

class ClientController extends ApiController
{
    public function search(int $cpf) 
    {
        $validator = Validator::make(['cpf' => $cpf], [
            'cpf' => ['required','numeric', 'digits:11', new CpfValidate],
        ]);

        if($validator->fails()) {
            return $this->response('Invalid CPF', 400);   
        }

        $client = Client::select('id', 'name', 'birth_date', 'cpf', 'phone_number')
                        ->where('cpf', $cpf)
                        ->first();

        if($client) {
            $client->getCurrentAge();
            return new ClientResource($client);
        }

        return $this->response('Client not found', 404);
    }
}
