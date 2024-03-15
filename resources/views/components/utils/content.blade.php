<div class="d-flex flex-wrap justify-content-center w-100 gap-3 mb-3 px-1 px-lg-3">
    @isset($header)
        <div class="w-100 d-flex justify-content-between align-items-center gap-1">
            {{ $header }}
        </div>
    @endisset
    {{ $body ?? $slot }}
</div>