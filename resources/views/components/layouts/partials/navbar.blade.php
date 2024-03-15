<div class="col-12 col-lg-2 bg-transparent">
    <nav class="navbar navbar-expand-lg py-0" data-bs-theme="dark">
        <div class="w-100 mx-2">
            <ul class="d-flex flex-row flex-lg-column justify-content-between navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-grid d-lg-flex align-items-center gap-1 {{ $actived('dashboard') }}" 
                       href="{{route('dashboard.index')}}"
                    >
                        <x-utils.icon class="text-center" name="dashboard" />
                        <span class="text-link-size">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-grid d-lg-flex align-items-center gap-1 {{ $actived('sale') }}" 
                       href="{{route('sale.index')}}"
                    >
                        <x-utils.icon class="text-center" name="point_of_sale" />
                        <span class="text-link-size">Sales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-grid d-lg-flex align-items-center gap-1 {{ $actived('client') }}" 
                       href="{{route('client.index')}}"
                    >
                        <x-utils.icon class="text-center" name="people" />
                        <span class="text-link-size">Clients</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-grid d-lg-flex align-items-center gap-1 {{ $actived('product') }}" 
                       href="{{route('product.index')}}"
                    >
                        <x-utils.icon class="text-center" name="shopping_bag" />
                        <span class="text-link-size">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-grid d-lg-flex align-items-center gap-1 {{ $actived('category') }}" 
                       href="{{route('category.index')}}"
                    >
                        <x-utils.icon class="text-center" name="category" />
                        <span class="text-link-size">Categories</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>