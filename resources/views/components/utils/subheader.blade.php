<div class="w-100 d-flex justify-content-between align-items-center py-1 px-1 px-lg-3 border rounded mb-3 shadow-sm">
    <h1>{{ $title }}</h1>
    @if($button != false)
        <a class="btn btn-outline-dark rounded d-flex justify-content-center align-items-center" href="{{$route}}">
            <x-utils.icon name="{{$icon}}"/>
        </a>
    @endif
</div>