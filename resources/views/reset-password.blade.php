@extends('layouts.guest')

@section('title', 'Reset Password')

@section('main')
    <form action="{{ route('password.update') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="token" value={{ $token }}>
        <input type="hidden" name="email" value={{ $email }}>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru" required>
            <label for="password">Password Baru</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                placeholder="Konfirmasi Password Baru" required>
            <label for="password_confirmation">Konfirmasi Password Baru</label>
        </div>


        <button class="w-100 btn btn-lg btn-primary mb-2 btn-sm" type="submit">Reset Password</button>

        <p class="mt-5 mb-3 text-muted">Klub Pemrograman TI POLNES &copy; 2022</p>
    </form>
@endsection
