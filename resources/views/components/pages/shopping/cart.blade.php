<x-layouts.default-layout title="Shopping Cart">
    <x-utils.modal id="modalClearCart" title="Clear shopping cart">
        <x-slot:body>
            <div class="w-100 alert alert-danger">
                <strong>Warning:</strong> Do you really want to clean your cart?
            </div>
        </x-slot:body>
        <x-slot:footer>
            <button class="btn btn-primary d-flex justify-content-center align-items-center gap-1" id="clearCart" data-bs-dismiss="modal">
                <span>To clear</span>
            </button>
        </x-slot:footer>    
    </x-utils.modal>
    <x-utils.subheader 
        title="Shopping Cart" 
        icon="shopping_bag" 
        :route="route('product.index')"
    />
    <x-utils.content>
        <x-slot:header>
            <x-pages.shopping.partials.header />
        </x-slot:header>
        <x-pages.shopping.partials.client-info />
        <div class="w-100 overflow-x-auto">
            <table class="table" id="shoppingCartTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumb</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </div>
        <div class="w-100 d-flex justify-content-between align-items-end gap-1">
            <div class="col-12 col-lg-5">
                <label for="payment_method">Payment method</label>
                <select class="form-control col-12 col-lg-5" name="payment_method" id="payment_method"></select>
            </div>
            <div class="d-flex justify-content-end gap-1 col-12 col-lg-5">
                <div>
                    <button class="btn btn-danger d-flex justify-content-center align-items-center gap-1"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalClearCart" 
                    >
                        <span>Cancel</span>
                        <x-utils.icon name="cancel"/>
                    </button>
                </div>
                <form id="checkoutShopping" action="{{ route('sale.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="client">
                    <input type="hidden" name="products">        
                    <input type="hidden" name="payment_method">
                    <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center gap-1">
                        <span>Confirm</span>
                        <x-utils.icon name="credit_score"/>
                    </button>
                </form>
            </div>
        </div>
    </x-utils.content>
</x-layouts.default-layout>