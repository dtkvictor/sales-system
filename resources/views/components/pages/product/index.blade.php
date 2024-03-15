<x-layouts.default-layout title="Product" >
    <x-utils.modal-delete
        id="deleteProduct"
        title="Delete Product"
    />    
    <x-utils.subheader 
        title="Products" 
        icon="add" 
        :route="route('product.create')"
    />
    <x-utils.content>
        <x-slot:header>
            <x-utils.filters.container>
                
                <x-utils.filters.order-by :options="[
                    array('name' => 'Default', 'value' => 'default'),
                    array('name' => 'Lowest price', 'value' => 'price.low'),
                    array('name' => 'Biggest price', 'value' => 'price.big'),
                    array('name' => 'Less quantity', 'value' => 'quantity.less'),
                    array('name' => 'Greater quantity', 'value' => 'quantity.greater')
                ]"></x-utils.filters.order-by>

                <x-utils.filters.filter-by-category/>
                <x-utils.filters.filter-by-number title="Min price" name="min"/>
                <x-utils.filters.filter-by-number title="Max price" name="max"/>
                <x-utils.filters.filter-by-date />

            </x-utils.filters.container>
            <x-utils.search></x-utils.search>
            <a class="btn btn-primary d-flex justify-content-center align-items-center" href="{{ route('shopping.cart') }}">
                <x-utils.icon name="shopping_cart_checkout"/>
            </a>
        </x-slot:header>
        <x-slot:body>
            <div class="w-100 overflow-x-auto">
                <x-pages.product.partials.table
                    :products="$products"
                />
            </div>
        </x-slot:body>
    </x-utils.content>
    {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
</x-layouts.default-layout>