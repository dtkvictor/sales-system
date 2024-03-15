<div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" name="category" id="category">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $value ? 'selected' : false }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>