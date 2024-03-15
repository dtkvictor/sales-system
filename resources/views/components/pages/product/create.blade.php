<x-layouts.default-layout title="Product | Create" >
    <x-utils.subheader title="Create Product" icon="keyboard_backspace" :route="route('product.index')"/>
    <x-utils.content>
        <x-pages.product.partials.form
            method="POST"
            :route="route('product.store')"
            :categories="$categories"
        />
    </x-utils.content>
</x-layouts.default-layout>