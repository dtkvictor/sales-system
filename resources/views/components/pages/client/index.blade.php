<x-layouts.default-layout title="Clients" >
    <x-utils.modal-delete
        id="deleteClient"
        title="Delete Client"
    />    
    <x-utils.subheader 
        title="Clients" 
        icon="add" 
        :route="route('client.create')"
    />
    <x-utils.content>
        <x-slot:header>
            <x-utils.filters.container>

                <x-utils.filters.order-by :options="[
                    array('name' => 'Name', 'value' => 'name'),
                    array('name' => 'Age', 'value' => 'age'),
                    array('name' => 'CPF', 'value' => 'cpf'),
                ]"></x-utils.filters.order-by>

            </x-utils.filters.container>
            <x-utils.search></x-utils.search>
        </x-slot:header>
        <x-slot:body>
            <div class="w-100 overflow-x-auto">
                <x-pages.client.partials.table
                    :clients="$clients"
                />
            </div>
        </x-slot:body>
    </x-utils.content>
    {!! $clients->withQueryString()->links('pagination::bootstrap-5') !!}
</x-layouts.default-layout>