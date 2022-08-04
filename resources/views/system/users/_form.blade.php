@section('scripts')
    @parent
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> --}}
@endsection

@section('stlyes')
    @parent
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
        rel="stylesheet" /> --}}
@endsection

{{ bcrypt('12345678') }}

<form action="{{ $user->exists ? route('system.users.update', $user) : route('system.users.store') }}"
    enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nama*</label>
        <input value="{{ $user->name }}" class="form-control" id="name" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email Login*</label>
        <input value="{{ $user->email }}" type="email" class="form-control" id="email" required>
        {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nomor Induk</label>
        <input value="{{ $user->name }}" class="form-control" id="name">
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">

                <label for="birthCity" class="form-label">Tempat Lahir</label>
                <input value="{{ $user->birth_city }}" class="form-control" id="birthCity">
            </div>

            <div class="col-md-6">
                <label for="birthDate" class="form-label">Tanggal Lahir</label>
                <input value="{{ $user->birth_city }}" type="date" class="form-control" id="birthDate">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="birthDate" class="form-label">Jenis Kelamin</label>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isMale" id="maleRadio">
                    <label class="form-check-label" for="maleRadio">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isMale" id="femaleRadio">
                    <label class="form-check-label" for="femaleRadio">
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <label for="religion" class="form-label">Agama</label>

                <select class="form-select" name="religion" id="religion">
                    <option selected value="" disabled></option>
                    <option>Islam</option>
                    <option>Katolik</option>
                    <option>Protestan</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Lainnya</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Hobi</label>
        <textarea class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Moto Hidup</label>
        <textarea class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Bio</label>
        <textarea class="form-control"></textarea>
    </div>

    <h3>Alamat</h3>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-7">
                <label for="address" class="form-label">Alamat KTP</label>
                <textarea class="form-control" id="address" name="address[]"></textarea>
            </div>

            <div class="col-md-5">
                <label for="birthDate" class="form-label">Kota</label>
                <select class="form-select" name="address_city" id="addressCity">
                    <option selected value="" disabled>Pilih Kota</option>
                    <option>Islam</option>
                    <option>Katolik</option>
                    <option>Protestan</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Lainnya</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-7">
                <label for="address" class="form-label">Domisili saat ini</label>
                <textarea class="form-control" id="address" name="address[]"></textarea>
            </div>

            <div class="col-md-5">
                <label for="birthDate" class="form-label">Kota</label>
                <select class="form-select" name="address_city" id="addressCity">
                    <option selected value="" disabled>Pilih Kota</option>
                    <option>Islam</option>
                    <option>Katolik</option>
                    <option>Protestan</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Lainnya</option>
                </select>
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-success">{{ 'Tambah' }}</button>
</form>
