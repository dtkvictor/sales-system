<x-layouts.default-layout title="Category | Create">
    <x-utils.subheader title="Create Category" icon="keyboard_backspace" :route="route('category.index')"/>
    <x-utils.content>
        <x-pages.category.partials.form 
            method="POST"
            route="{{route('category.store')}}"/>
    </x-utils.content>
</x-layouts.default-layout>