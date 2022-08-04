@extends('layouts.main')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>

    <script>
        function copyPassword() {
            var copyText = document.getElementById("password");
            copyText.select();
            document.execCommand("copy");
        }

        function generatePassword() {
            var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var passwordLength = 12;
            var password = "";

            for (var i = 0; i <= passwordLength; i++) {
                var randomNumber = Math.floor(Math.random() * chars.length);
                password += chars.substring(randomNumber, randomNumber + 1);
            }

            document.getElementById("password").value = password;
            document.getElementById("password_confirmation").value = password;

            copyPassword();
        }
    </script>
@endsection

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pengguna</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            {{-- <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div> --}}
            {{-- <a href="{{ route('users.create') }}" type="button" class="btn btn-outline-secondary">
                <i class="bi bi-plus-circle align-bottom"></i>
                Tambah
            </a> --}}

            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                data-bs-whatever="@getbootstrap">
                <i class="bi bi-plus-circle align-bottom"></i>
                Tambah

            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nomor Induk</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Peran</th>
                    <th scope="col">Web Admin</th>
                    <th scope="col">Rincian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id_number }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                    @if ($user->is_admin) checked @endif>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('system.users.edit', $user->id) }}" class="btn btn-sm btn-link"><i
                                    class="bi bi-eye-fill align-bottom"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('system.users.store') }}" id="userForm" method="POST" autocomplete="off">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                                    required>
                                <label for="name">Nama</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                    required>
                                <label for="email">Email Login</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-secondary align" type="button"
                                        onclick="generatePassword()">Generate Password</button>
                                </div>
                                <div class="col-md-2">
                                    <button data-bs-toggle="tooltip" data-bs-title="Copy" class="btn btn-link"
                                        type="button" onclick="copyPassword()">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Konfirmasi Password" required>
                                <label for="password_confirmation">Konfirmasi Password</label>
                            </div>



                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" form="userForm" class="btn btn-success">Buat Akun</button>
                    </div>
                </div>
            </div>
        </div>

        {{ $users->links() }}
    </div>
@endsection
