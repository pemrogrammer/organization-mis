@extends('layouts.main')
@section('title', 'Atur Password')

@section('main')
    <form action="{{ route('account.change-password') }}" method="POST" autocomplete="off">
        @csrf

        @if ($user->password)
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Password Lama"
                    required>
                <label for="old_password">Password Lama</label>
            </div>
        @endif

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password Baru"
                required>
            <label for="new_password">Password Baru</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                placeholder="Konfirmasi Password Baru" required>
            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
        </div>

        <div class="col-12 mt-5">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>


@endsection
