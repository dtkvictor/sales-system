<x-utils.form.container id="categoryForm" :method="$method" :route="$route">
    <div class="mb-3">
        <label for="thumb" class="form-label">Thumb</label>
        <x-utils.form.input-image id="thumb" name="thumb" :default=" $category->thumb ?? '' "/>
        <small class="text-danger">{{ $errors->has('thumb') ? $errors->first('thumb') : '' }}</small>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? $category->name ?? ''}}">
        <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">{{ old('description') ?? $category->description ?? ''}}</textarea>
        <small class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</small>
    </div>

</x-utils.form.container>