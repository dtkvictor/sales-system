<?php

namespace App\Http\Controllers;

use App\Http\Filters\ClientFilter;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use App\Helpers\StringUtils;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = new ClientFilter(Client::withCount('shopping as total_shopping'));
        $clients = $clients->apply(request()->query())->paginate(10);
        
        $clients->each(function($client) {
            $client->getCurrentAge();
            $client->getCpfWithMask();
            $client->getPhoneNumberWithMask();
        });

        return view('components.pages.client.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.pages.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        try {
            $client = new Client();
            $client->name = $request->name;
            $client->cpf = $request->cpf;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->save();

            $request->session()->put('success', 'Client Registered successfully');
        }catch(QueryException) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('client.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->getListShoppings();
        $client->getCurrentAge();
        $client->getCpfWithMask();
        $client->getPhoneNumberWithMask();

        return view('components.pages.client.show', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('components.pages.client.update', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            $client->name = $request->name;
            $client->cpf = $request->cpf;
            $client->birth_date = $request->birth_date;
            $client->phone_number = $request->phone_number;
            $client->save();

            $request->session()->put('success', "Client $client->name updated successfully.");
        }
        catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }

        return redirect()->route('client.edit', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client = $client->name;
        try {
            $client->delete();
            request()->session()->put('success', 'Client deleted successfully');
        }
        catch(QueryException $e) {
            $request->session()->put('fails', "Error performing the operation on the database. Code: {$e->getCode()}");
        }
        return redirect()->route('client.index');
    }
}
