<div class="d-flex justify-content-{{$position ?? 'center'}} items-center mb-3">
    <img class="rounded-1 border" 
            src="{{ $default ?? '' }}"
            width="{{ $width ?? '100px' }}" 
            height="{{ $height ?? '100px' }}"
            data-image-load="img"
            onerror="this.src='{{asset('assets/image/default.png')}}'"
    />
</div>
<input type="file" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        class="form-control"
        data-image-load="input"
>