<x-layouts.default-layout title="Register">
    <div class="d-flex justify-content-center align-items-center" style="height: calc(100% - 72px)">
        <form action="{{ route('auth.register') }}" method="POST" class="rounded form-width">
            <h1 class="mb-3 text-center">Register</h1>
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input class="form-control" type="name" id="name" name="name" value="{{ old('name') }}" autocomplete="name">
                <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email">
                <small class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" value="{{ old('password') }}" autocomplete="password">
                <small class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</small>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password_confirmation">Password confirm</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                <small class="text-danger">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</small>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
            <a class="d-block w-100 text-center" href="{{route('auth.login.view')}}">Already a member? Login</a>
        </form>
    </div>
</x-layouts.default-layout>