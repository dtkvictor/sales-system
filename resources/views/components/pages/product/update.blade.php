<x-layouts.default-layout title="Product | Update" >
    <x-utils.subheader title="Update Product" icon="keyboard_backspace" :route="route('product.index')"/>
    <x-utils.content>
        <x-pages.product.partials.form
            method="PUT"
            :route="route('product.update', $product->id)"    
            :product="$product"
            :categories="$categories"
        />
    </x-utils.content>
</x-layouts.default-layout>