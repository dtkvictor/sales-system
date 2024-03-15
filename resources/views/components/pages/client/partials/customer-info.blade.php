<div class="card w-100">
    <div class="card-header">
        Customer info
    </div>
    <ul class="card-body pb-0">      
        <li>
            <strong>CPF: </strong>
            <span>{{ StringUtils::maskCPF($client->cpf) }}</span>
        </li>
        <li>
            <strong>Name: </strong>
            <span>{{ $client->name}}</span>
        </li>
        <li>
            <strong>Phone number: </strong>
            <span>{{ StringUtils::maskPhoneNumberPtBR($client->phone_number) }}</span>
        </li>
    </ul>
</div>