<div class="mb-3">
    <label for="orderBy" class="form-label">Order by</label>
    <select class="form-select" name="order-by" id="orderBy">
        @if(empty($options))
          <option value="ASC" {{ $orderByValue == "ASC" ? 'selected' : false }}>Ascending</option>
          <option value="DESC" {{ $orderByValue == "DESC" ? 'selected' : false }}>Descending</option>
        @else
          @foreach($options as $option)
            <option value="{{ $option['value'] }}" {{ $orderByValue == $option['value'] ? 'selected' : false }}>
              {{ $option['name'] }}
            </option>
          @endforeach
        @endif
      </select>
</div>