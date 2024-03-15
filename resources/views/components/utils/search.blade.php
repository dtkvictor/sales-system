<form class="w-auto input-group" role="search" id="{{ $id ?? 'navbarFormSearch' }}">
    <input class="form-control" type="search" name="search" placeholder="{{$placeholder ?? 'Search'}}" aria-label="Search" value="{{$oldValue}}">
    <button class="btn btn-outline-secondary d-flex justify-content-center align-items-center" type="submit">
        <x-utils.icon name="search"/>
    </button>
</form>