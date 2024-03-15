<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">CPF</th>
        <th scope="col">Age</th>
        <th scope="col">Phone number</th>
        <th scope="col">Total Shopping</th>
    </tr>
    </thead>
    <tbody>
        @foreach($clients as $client) 
            <tr>
                <th scope="row">{{ $client->id }}</th>
                <td>{{ $client->name }}</td>
                <td>{{ $client->cpf }}</td>
                <td>{{ $client->age }}</td>
                <td>{{ $client->phone_number }}</td>
                <td>{{ $client->total_shopping }}</td>
                <td class="w-100 d-flex justify-content-end gap-1 p-1 border-top">
                    <a class="btn btn-info d-flex justify-content-center align-items-center p-1" href="{{route('client.show', $client->id)}}">
                        <x-utils.icon name='remove_red_eye'/>
                    </a>
                    <a class="btn btn-warning d-flex justify-content-center align-items-center p-1" href="{{route('client.edit', $client->id)}}">
                        <x-utils.icon name='edit'/>
                    </a>
                    <button type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteClient" 
                            data-delete-route="{{route('client.destroy', $client->id)}}"
                            data-delete-message="Do you really want to delete the client {{$client->name}}?"
                            class="btn btn-danger d-flex justify-content-center align-items-center p-1"
                    >
                        <x-utils.icon name='delete'/>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>