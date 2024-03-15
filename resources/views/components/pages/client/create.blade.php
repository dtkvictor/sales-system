<x-layouts.default-layout title="Clients" >
    <x-utils.subheader title="Register Client" icon="keyboard_backspace" :route="route('client.index')"/>
    <x-utils.content>
        <x-pages.client.partials.form :route="route('client.store')" method="POST"/>
    </x-utils.content>
</x-layouts.default-layout>