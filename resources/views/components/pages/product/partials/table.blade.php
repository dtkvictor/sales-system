<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Thumb</th>
            <th>Name</th>
            <th>Price</th>
            <th>Inventory</th>
            <th>Last updated</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <th> {{ $product->id }} </th>
                <td>
                    <img src="{{ $product->thumb }}" 
                        onerror="this.src='{{asset('assets/image/default.png')}}'"
                        width="48"
                        height="48"
                    >
                </td>
                <td> {{ $product->name }} </td>
                <td> ${{ number_format($product->price, 2) }} </td>
                <td> {{ $product->inventory }} </td>
                <td> {{ $product->updated_at }} </td>
                <td>
                    <div class="d-flex gap-1">                             
                        <a class="btn btn-warning d-flex justify-content-center align-items-center gap-1 p-1" 
                            href="{{route('product.edit', $product->id)}}"
                        >                                
                            <x-utils.icon name='edit'/>
                        </a>                                          
                        <button type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteProduct" 
                            data-delete-route="{{route('product.destroy', $product->id)}}"
                            data-delete-message="Do you really want to delete the {{$product->name}} product?"
                            class="btn btn-danger d-flex justify-content-center align-items-center p-1"
                        >                                    
                            <x-utils.icon name='delete'/>
                        </button>                        
                    </div>
                </td>
                <td>
                    <div class="d-flex gap-1" data-cart-handler-content='{!! json_encode($product) !!}'>
                        <button data-action="remove" class="btn btn-danger d-flex justify-content-center align-items-center p-1">                    
                            <x-utils.icon name="remove"/>
                        </button>
                        <span data-action="show-amount" class="input-group-text">0</span>
                        <button data-action="add" class="btn btn-primary d-flex justify-content-center align-items-center p-1">
                            <x-utils.icon name="add"/>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>