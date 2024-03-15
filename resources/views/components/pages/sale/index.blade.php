<x-layouts.default-layout title="Sale">
    <x-utils.modal-delete
        id="deleteSale"
        title="Delete Sale"
    />    
    <x-utils.subheader 
        title="Sales" 
        icon="shopping_bag" 
        :route="route('product.index')"
    />
    <x-utils.content>
        <x-slot:header>
            <x-utils.filters.container>
                
                <x-utils.filters.filter-by-my-sales />

                <x-utils.filters.order-by :options="[
                    array('name' => 'Default', 'value' => 'default'),
                    array('name' => 'Lowest value', 'value' => 'total_amount.low'),
                    array('name' => 'Biggest value', 'value' => 'total_amount.big'),
                ]"></x-utils.filters.order-by>

                <x-utils.filters.filter-by-number title="Min Value" name="min"/>
                <x-utils.filters.filter-by-number title="Max Value" name="max"/>
                <x-utils.filters.filter-by-payment-method />
                <x-utils.filters.filter-by-hour />
                <x-utils.filters.filter-by-date />

            </x-utils.filters.container>
            <x-utils.search></x-utils.search>
        </x-slot:header>
        <x-slot:body>
            <div class="w-100 overflow-x-auto">
                <x-pages.sale.partials.table
                    :sales="$sales"
                />
            </div>
        </x-slot:body>
    </x-utils.content>
    {!! $sales->withQueryString()->links('pagination::bootstrap-5') !!}
</x-layouts.default-layout>