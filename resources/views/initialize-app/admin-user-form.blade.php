@extends('layouts.initialize-app')

@section('main')
    <form action="{{ route('initialize-app.store-admin-user') }}" method="POST" autocomplete="off">
        @csrf

        <div class="form-floating mb-3">
            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" required
                value="{{ old('name') }}" placeholder="Nama">
            <label for="name">Nama</label>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                required value="{{ old('email') }}" placeholder="Email">
            <label for="email">Email</label>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required placeholder="Password">
            <label for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
                placeholder="Konfirmasi Password">
            <label for="password_confirmation">Konfirmasi Password</label>
        </div>

        <button type="submit" class="btn btn-primary mb-5">Submit</button>
    </form>
@endsection
