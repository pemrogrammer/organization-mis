@extends('layouts.guest')

@section('main')
    <form action="{{ route('login.login') }}" method="POST">
        @csrf

        <div class="form-floating">
            <input type="email" value="{{ old('email') }}" name="email"
                class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com"
                required>
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                id="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="checkbox mb-3 d-flex justify-content-between">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>

            <a href="{{ route('forgot-password') }}">Lupa password?</a>
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-2 btn-sm" type="submit">Sign in</button>
        <p>atau</p>
        <a class="w-100 btn btn-lg btn-outline-dark btn-sm" href="{{ route('login.oauth.google') }}">Login dengan
            Google</a>

        <p class="mt-5 mb-3 text-muted">Klub Pemrograman TI POLNES &copy; 2022</p>
    </form>
@endsection
