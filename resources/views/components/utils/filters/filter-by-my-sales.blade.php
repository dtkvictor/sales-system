<div class="mb-3 d-flex justify-content-between border-bottom">
    <label class="form-check-label" for="filterByMySales">My Sales</label>
    <div class="form-switch">
        <input class="form-check-input" name="my-sales" type="checkbox" role="switch" id="filterByMySales" {{ $value ? 'checked' : '' }}>
    </div>
</div>