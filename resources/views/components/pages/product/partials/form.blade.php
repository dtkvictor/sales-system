@php
    function selected($product, $category): string
    {
        if($product == null) return "";
        if($product->category->id == $category->id) {
            return "selected";
        }
        return "";
    }
@endphp

<x-utils.form.container id="productForm" :method="$method" :route="$route">
    <div class="mb-3">
        <label for="thumb" class="form-label">Thumb</label>
        <x-utils.form.input-image id="thumb" name="thumb" :default=" $product->thumb ?? '' "/>
        <small class="text-danger">{{ $errors->has('thumb') ? $errors->first('thumb') : '' }}</small>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? $product->name ?? ''}}">
        <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" id="price" name="price" step="any" class="form-control" value="{{ old('price') ?? $product->price ?? ''}}">
        <small class="text-danger">{{ $errors->has('price') ? $errors->first('price') : '' }}</small>
    </div>

    <div class="mb-3">
        <label for="inventory" class="form-label">Inventory</label>
        <input type="number" id="inventory" name="inventory" class="form-control" value="{{ old('inventory') ?? $product->inventory ?? ''}}">
        <small class="text-danger">{{ $errors->has('inventory') ? $errors->first('inventory') : '' }}</small>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-control" id="category" name="category">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ selected($product ?? null, $category) }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description') ?? $product->description ?? ''}}</textarea>
        <small class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</small>
    </div>
</x-utils.form.container>