<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">User</th>
        <th scope="col">Date</th>
        <th scope="col">Payment Method</th>
        <th scope="col">Total Amount</th>
    </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale) 
            <tr>
                <th scope="row">{{ $sale->id }}</th>
                <td>{{ $sale->user->name }}</td>
                <td>{{ $sale->created_at }}</td>
                <td>{{ $sale->payment_method }}</td>
                <td>${{ number_format($sale->total_amount, 2) }}</td>
                <td class="w-100 d-flex justify-content-end gap-1 p-1 border-top">
                    <a class="btn btn-info d-flex justify-content-center align-items-center p-1" href="{{route('sale.show', $sale->id)}}">
                        <x-utils.icon name='remove_red_eye'/>
                    </a>
                    {{--<a class="btn btn-warning d-flex justify-content-center align-items-center p-1" href="{{route('sale.edit', $sale->id)}}">
                        <x-utils.icon name='edit'/>
                    </a>--}}
                    <button type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteSale" 
                            data-delete-route="{{route('sale.destroy', $sale->id)}}"
                            data-delete-message="Do you really want to delete the sale {{$sale->id}}?"
                            class="btn btn-danger d-flex justify-content-center align-items-center p-1"
                    >
                        <x-utils.icon name='delete'/>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>