<x-layouts.default-layout title="Category | Update">
    <x-utils.subheader title="Update Category" icon="keyboard_backspace" :route="route('category.index')"/>
    <x-utils.content>
        <x-pages.category.partials.form
            route="{{route('category.update', $category->id)}}"
            method="PUT"
            :category="$category"
        />
    </x-utils.content>
</x-layouts.default-layout>