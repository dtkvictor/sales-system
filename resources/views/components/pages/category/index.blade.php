<x-layouts.default-layout title="Category">
    <x-utils.modal-delete
        id="deleteCategory"
        title="Delete Category"
    />    
    <x-utils.subheader 
        title="Categories" 
        icon="add" 
        :route="route('category.create')"
    />
    <x-utils.content>
        <x-slot:header>
            <x-utils.filters.container>
                <x-utils.filters.order-by/>
                <x-utils.filters.filter-by-date/>
            </x-utils.filters.container>
            <x-utils.search></x-utils.search>
        </x-slot:header>

        <x-slot:body>
            <div class="w-100 overflow-x-auto">
                <x-pages.category.partials.table
                    :categories="$categories" 
                />
            </div>
        </x-slot:body>
    </x-utils.content>
    {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!}
</x-layouts.default-layout>