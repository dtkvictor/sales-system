<x-layouts.default-layout title="Clients | Show" >
    <x-utils.subheader 
        title="Sale info" 
        icon="keyboard_backspace" 
        :route="route('sale.index')"
    />
    <x-utils.content>  
        <div class="card w-100">
            <div class="card-header">
                Client
            </div>
            <ul class="card-body pb-0">      
                <li>
                    <strong>CPF: </strong>
                    <span>{{ StringUtils::maskCPF($sale->client->cpf) }}</span>
                </li>
                <li>
                    <strong>Name: </strong>
                    <span>{{ $sale->client->name}}</span>
                </li>
                <li>
                    <strong>Phone number: </strong>
                    <span>{{ StringUtils::maskPhoneNumberPtBR($sale->client->phone_number) }}</span>
                </li>
            </ul>
        </div>
        <div class="card w-100">
            <div class="card-header">
                Items
            </div>
            <div class="card-body pb-0 overflow-x-auto">
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Total amount</th>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)                        
                            <tr>
                                <th>{{ $item->id }}</th>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ number_format(($item->amount * $item->unit_price), 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>                
                </table>
            </div>
        </div>
    </x-utils.content>
</x-container>