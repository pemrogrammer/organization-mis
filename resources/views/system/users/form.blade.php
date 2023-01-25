@extends('layouts.main')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $user->exists ? 'Ubah ' . $user->name : 'Tambah Pengguna' }}</h1>
    </div>

    @if (Session::has('message'))
        @php
            $msg = Session::get('message');
        @endphp
        <div class="alert alert-{{ $msg['class'] }}" role="alert">
            {{ $msg['text'] }}
        </div>
    @endif

    <h2 class="h3 mt-5">Peran Sistem</h2>
    @if ($user->roles->isNotEmpty())
        @foreach ($user->roles as $role)
            <form action="{{ route('system.users.roleDestroy') }}" method="POST" class="d-inline p-1">
              @csrf

              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <input type="hidden" name="role_id" value="{{ $role->id }}">

            <span class="badge rounded-pill text-bg-secondary">
                {{ $role->name }} <button class="btn rounded-circle"><i class="bi bi-x-lg align-bottom"></i></button>
            </span>
            </form>
        @endforeach

    @else
        <p class="text-danger">Peran pengguna belum diatur.</p>
    @endif

    <form action="{{ route('system.users.roleStore') }}" method="POST" class="row row-cols-lg-auto g-3 align-items-center mt-3">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="col-12">
            <label class="visually-hidden" for="roleSelect">Peran</label>
            <select class="form-select" id="roleSelect" name="role_id" required>
                <option selected value="" disabled>Silahkan pilih peran</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Peran
            </button>
        </div>
    </form>

    <h2 class="h3 mt-5">Biodata</h2>
    @include('system.users._form')


@endsection
