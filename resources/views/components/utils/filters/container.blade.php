<button class="btn btn-outline-dark d-flex justify-content-center align-items-center" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#filtersContainer" 
        aria-controls="offcanvasRight"
>
    <x-utils.icon name='settings_input_component'/>
</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="filtersContainer" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Filter by</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form class="" role="search" id="filterForm">
        {{ $slot }}
        <div class="d-flex justify-content-between border-top pt-1 gap-1">
            <a class="d-flex align-items-center" href="{{ $clearFilterRoute  }}">
              Clear filters
            </a>
            <button class="btn btn-primary d-flex justify-content-center align-items-center" type="submit">
                Fetch
            </button>
        </div>
    </form>
  </div>
</div>