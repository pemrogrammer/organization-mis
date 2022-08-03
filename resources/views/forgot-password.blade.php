@extends('layouts.guest')

@section('title', 'Lupa Password')
@section('main')
    <form action="{{ route('forgot-password.send') }}" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <input type="email" value="{{ old('email') }}" name="email"
                class="form-control @error('email') is-invalid @enderror" id="email" placeholder=" " required>
            <label for="email">Email address</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mb-2 btn-sm" type="submit">Reset Password</button>

        <p>atau</p>

        <a href="{{ route('login') }}">Kembali ke halaman login</a>


        <p class="mt-5 mb-3 text-muted">Klub Pemrograman TI POLNES &copy; 2022</p>
    </form>
@endsection
