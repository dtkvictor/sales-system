<x-layouts.default-layout title="Clients | Show" >
    <x-pages.client.partials.shopping-items-modal/>

    <x-utils.modal-delete
        id="deleteClient"
        title="Delete Client"
    />

    <x-utils.subheader 
        title="Client Info" 
        icon="keyboard_backspace" 
        :route="route('client.index')"
    />

    <x-utils.content>
        <x-pages.client.partials.customer-info
            :client="$client"
        />
        <x-pages.client.partials.shopping 
            :shoppings="$client->shoppings"
        />
    </x-utils.content>
</x-container>