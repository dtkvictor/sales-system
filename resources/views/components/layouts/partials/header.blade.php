<header class="bg-dark navbar navbar-expand-lg p-3 pb-0 pb-lg-3" data-bs-theme="dark">
    <div class="w-100 d-flex justify-content-between">
        <a class="navbar-brand text-white" href="#">SRV Admin</a>
        <ul class="navbar-nav mb-2 mb-lg-0">
            @auth
                <li class="nav-item">
                    <form action="{{ route('auth.logout') }}" method="POST" id="form-logout">
                        @csrf
                        <button class="nav-link d-flex align-items-center gap-1">
                            <span>Logout</span>
                            <x-utils.icon name='logout'/>
                        </button>
                    </form>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-1" href="{{ route('auth.login') }}">
                        <span>Login</span>
                        <x-utils.icon name='login'/>
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</header>