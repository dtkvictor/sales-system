<form id={{$id}} action="{{ $route }}" method="POST" class="border shadow-sm rounded p-3 form-width" enctype="multipart/form-data">
    @csrf
    @method($method)

    {{ $slot }}

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            {{ strtolower($method) == 'post' ? "Create" : "Update" }}
        </button>
    </div>
</form>