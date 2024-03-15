<div class="card w-100">
    <div class="card-header">
        Shoppings
    </div>
    <div class="card-body pb-0 overflow-x-auto">
        <table class="table">
            <thead>
                <th scope="col">Id</th>
                <th scope="col">Operator</th>
                <th scope="col">Payment method</th>
                <th scope="col">Total Amount</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($shoppings as $shop)
                    <tr>
                        <th scope="row">{{ $shop->id }}</th>
                        <td>{{ $shop->user->name }}</td>
                        <td>{{ StringUtils::slugToText($shop->payment_method) }}</td>
                        <td>${{ number_format($shop->total_amount, 2) }}</td>
                        <td class="d-flex justify-content-end pe-0">
                            <button type="button" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#showItemsShopping" 
                                            data-shopping-items="{{ json_encode($shop->items) }}"
                                            class="btn btn-primary d-flex justify-content-center align-items-center p-1"
                                    >
                                    <x-utils.icon name='remove_red_eye'/>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>                
        </table>
        {!! $shoppings->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>