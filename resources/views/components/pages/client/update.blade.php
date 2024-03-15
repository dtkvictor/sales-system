<x-layouts.default-layout title="Clients">
    <x-utils.subheader title="Update Client" icon="keyboard_backspace" :route="route('client.index')"/>
    <x-utils.content>
        <x-pages.client.partials.form :route="route('client.update', $client->id)" method="PUT" :client="$client"/>
    </x-utils.content>
</x-layouts.default-layout>