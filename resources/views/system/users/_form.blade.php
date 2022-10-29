@section('scripts')
    @parent
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> --}}
@endsection

@section('stlyes')
    @parent
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
        rel="stylesheet" /> --}}
@endsection

<form action="{{ $user->exists ? route('system.users.update', $user) : route('system.users.store') }}"
    enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input type="hidden" name="profile" value="{{$profile}}">
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
        <input value="{{ $user->id_number }}" class="form-control" id="name" name="id_number">
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">

                <label for="birthCity" class="form-label">Tempat Lahir</label>
                <input value="{{ $user->birth_city }}" class="form-control" id="birthCity" name="birthCity">
            </div>

            <div class="col-md-6">
                <label for="birthDate" class="form-label">Tanggal Lahir</label>
                <input value="{{ $user->birth_date }}" type="date" class="form-control" id="birthDate" name="birthDate">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <label for="birthDate" class="form-label">Jenis Kelamin</label>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isMale" id="maleRadio" {{($user->is_male == 1 ? 'checked' : '')}}>
                    <label class="form-check-label" for="maleRadio">
                        Laki-laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="isMale" id="femaleRadio" {{($user->is_male == 0 ? 'checked' : '')}}>
                    <label class="form-check-label" for="femaleRadio">
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="col-md-6">
                <label for="religion" class="form-label">Agama</label>

                <select class="form-select" name="religion" id="religion">
                    <option selected value="" disabled></option>
                    <option {{($user->religion == 'Islam' ? 'selected' : '')}}>Islam</option>
                    <option {{($user->religion == 'Katolik' ? 'selected' : '')}}>Katolik</option>
                    <option {{($user->religion == 'Protestan' ? 'selected' : '')}}>Protestan</option>
                    <option {{($user->religion == 'Hindu' ? 'selected' : '')}}>Hindu</option>
                    <option {{($user->religion == 'Budha' ? 'selected' : '')}}>Budha</option>
                    <option {{($user->religion == 'Lainnya' ? 'selected' : '')}}>Lainnya</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Hobi</label>
        <textarea class="form-control" name="hobi" >{{($user->hobby)}}</textarea>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Moto Hidup</label>
        <textarea class="form-control" name="moto" >{{($user->motto)}}</textarea>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Bio</label>
        <textarea class="form-control" name="bio" >{{($user->bio)}}</textarea>
    </div>

    <div class="mb-3">
        <p><label for="formFile" class="form-label form-foto">Foto</label></p>
        <label class="text-center border border-1 rounded d-block mb-1" for="formFile"><img src="{{($user->img_path == null ? '/assets/foto/kosong.png' : '/assets/foto/'.$user->img_path)}}" height="250px"></label>
        <input class="form-control" type="file" id="formFile" name="foto">
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
                <select class="form-control" name="address_city[]" id="addressCity1">
                    <option selected disabled>Pilih kota</option>
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
                <select class="form-control" name="address_city[]" id="addressCity2">
                    <option selected disabled>Pilih kota</option>
                </select>
            </div>
        </div>
    </div>


    <button type="submit" class="btn btn-success">{{ ($user->exists ? 'Ubah' : 'Tambah') }}</button>
</form>

