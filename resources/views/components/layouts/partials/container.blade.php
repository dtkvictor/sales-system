<main class="w-100 d-flex flex-wrap justify-content-center px-3 px-lg-0">
    @auth
       <x-layouts.partials.navbar></x-layouts.partials.navbar> 
    @endauth
    
    <div class="container-body-height col-12 bg-white p-3 rounded-top rounded-lg-none {{ auth()->check() ? 'col-lg-10' : '' }}">
        {{ $slot }}
    </div>

    @if(($feedback = request()->session()->pull('success')) != null)
        <x-utils.toast type="success">{{ $feedback }}</x-utils.toast>
    @elseif(($feedback = request()->session()->pull('fails')) != null)
        <x-utils.toast type="danger">{{ $feedback }}</x-utils.toast>
    @endif
</main>