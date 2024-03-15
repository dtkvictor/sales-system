<x-layouts.default-layout title="Login">
    <div class="d-flex justify-content-center align-items-center" style="height: calc(100% - 72px)">
        <form action="{{ route('auth.login') }}" method="POST" class="w-100 rounded form-width" id="form-login">
            <h1 class="mb-3 text-center">Login</h1>
            @csrf
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email">
                <small class="text-danger" id="error-email">
                    {{ $errors->has('email') ? $errors->first('email') : '' }}
                </small>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" value="{{ old('password') }}" autocomplete="password">
                <small class="text-danger" id="error-password">
                    {{ $errors->has('password') ? $errors->first('password') : '' }}
                </small>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
            <a class="d-block w-100 text-center" href="{{route('auth.register.view')}}">Not a member? Register</a>
        </form>
    </div>
</x-layouts.default-layout>