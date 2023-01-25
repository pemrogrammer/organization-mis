@extends('layouts.main')

@section('scripts')
    <script type="text/javascript">
        <?php $i = 0 ?>
        $(document).on('click', '#tombolTambahEdu', function(){
            let id = $(this).data('id')
            let user_id = $(this).data('user_id')
            let eduid = $(this).data('eduid')
            let institution = $(this).data('institution')
            let from_year = $(this).data('from_year')
            let to_year = $(this).data('to_year')
            const ubahForm = document.querySelector('#ubahForm')

            $("#institution").val(institution)
            $("#user_education_id").val(id)
            $("#user_id").val(user_id)
            $("#from_year").val(from_year)
            $("#to_year").val(to_year)
            $("#id_delete").val(user_id)
            $("#id_edu_delete").val(id)
            $('.hapus').hide()
            ubahForm.action = "{{route('account.set-education')}}"

            const select = document.querySelector('#roleSelect');
            select.value = ''
        })

        $(document).on('click', '#tombolUbahEdu', function(){
            let id = $(this).data('id')
            let eduid = $(this).data('eduid')
            let user_id = $(this).data('user_id')
            let institution = $(this).data('institution')
            let from_year = $(this).data('from_year')
            let to_year = $(this).data('to_year')
            const ubahForm = document.querySelector('#ubahForm')

            $("#institution").val(institution)
            $("#user_education_id").val(id)
            $("#user_id").val(user_id)
            $("#from_year").val(from_year)
            $("#to_year").val(to_year)
            $("#id_delete").val(user_id)
            $("#id_edu_delete").val(id)
            $('.hapus').show()
            ubahForm.action = "{{route('account.update-education')}}"

            const select = document.querySelector('#roleSelect');
            select.value = $(this).data('eduid')
        })

        $(document).on('click', '#tombolTambahExp', function(){
            let id = $(this).data('id')
            let user_id = $(this).data('user_id')
            let position = $(this).data('posisi')
            let institution = $(this).data('institution')
            const pengalamanForm = document.querySelector('#pengalamanForm')

            $("#expInstitution").val(institution)
            $("#posisi").val(position)
            $("#exp_id").val(id)
            $("#user_exp_id").val(user_id)
            $("#id_delete").val(user_id)
            $("#id_edu_delete").val(id)
            $('.hapus').hide()
            pengalamanForm.action = "{{route('account.set-experience')}}"
        })

        $(document).on('click', '#tombolUbahExp', function(){
            let id = $(this).data('id')
            let user_id = $(this).data('user_id')
            let position = $(this).data('posisi')
            let institution = $(this).data('institution')
            const pengalamanForm = document.querySelector('#pengalamanForm')

            $("#expInstitution").val(institution)
            $("#posisi").val(position)
            $("#exp_id").val(id)
            $("#user_exp_id").val(user_id)
            $("#id_delete").val(user_id)
            $("#id_edu_delete").val(id)
            $('.hapus').show()
            pengalamanForm.action = "{{route('account.update-experience')}}"
        })


        ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    $(document).on('click', '#tombolUbahAchievements', function(){
                        let idUser = $(this).data('user_id')
                        let idAchi = $(this).data('id')
                        let description = $(this).data('description')
                        const pencapaianForm = document.querySelector('#pencapaianForm')
                        editor.setData( description );

                        $('#userAchievementsId').val(idUser);
                        $('#idAchievements').val(idAchi);
                        $('#editor').html(description)
                        $('#deleteUserIdAchievements').val(idUser)
                        $('#deleteIdAchievements').val(idAchi)
                        pencapaianForm.action = "{{route('account.update-achievements')}}"
                        $('.hapus').show()
                    })

                    $(document).on('click', '#tombolTambahAchievements', function(){
                        let idUser = $(this).data('user_id')
                        let idAchi = $(this).data('id')
                        let description = $(this).data('description')
                        const pencapaianForm = document.querySelector('#pencapaianForm')
                        editor.setData( description );

                        $('#userAchievementsId').val(idUser)
                        $('#idAchievements').val(idAchi);
                        $('#editor').html('asdasdasd')
                        $('#deleteUserIdAchievements').val(user_id)
                        $('#deleteIdAchievements').val(idAchi)
                        pencapaianForm.action = "{{route('account.set-achievements')}}"
                        $('.hapus').hide()
                    })
                    
                } )
                .catch( error => {
                    console.error( error );
                } );
    </script>
@endsection

@section('main')
    <!-- bagian read riwayat pendidikan -->
    @if (Session::has('message'))
        @php
            $msg = Session::get('message');
        @endphp
        <div class="alert alert-{{ $msg['class'] }}" role="alert">
            {{ $msg['text'] }}
        </div>
    @endif

    <h2 class="h3 mt-5">Riwayat Pendidikan</h2>
    @if ($user->educations->isNotEmpty())

        <table class="table table-striped table-sm">
                <tr>
                    <th>Jenjang</th>
                    <th>Institusi</th>
                    <th>Angkatan-Alumni</th>
                    <th>
                        Rincian
                    </th>
                </tr>
                @foreach ($user_education as $edu)
                        <tr class="">
                            <td>{{$edu->name}}</td>
                            <td>{{$edu->institution}}</td>
                            <td>{{$edu->from_year}} - {{$edu->to_year}}</td>
                            <td>
                                <a class="btn btn-primary rounded-pill" id="tombolUbahEdu" data-bs-toggle="modal" data-bs-target="#ubahModal" data-id="{{$edu->id}}" data-institution="{{$edu->institution}}" data-user_id="{{Auth::user()->id}}" data-from_year="{{$edu->from_year}}" data-to_year="{{$edu->to_year}}" data-eduid="{{$edu->education_id}}"  data-bs-whatever="@getbootstrap"><i class="bi bi-eye-fill align-bottom"></i></a>
                            </td>
                        </tr>
                @endforeach
            </table>
    @else
        <p class="text-danger">Jenjang pendidikan belum dimasukan.</p>
    @endif

    <button type="button" class="btn btn-outline-primary" id="tombolTambahEdu" data-bs-toggle="modal" data-bs-target="#ubahModal" data-id="" data-institution="" data-from_year="" data-to_year="" data-user_id="{{Auth::user()->id}}" data-bs-whatever="@getbootstrap">
        <i class="bi bi-plus-circle align-bottom"></i>Tambah
    </button>
    <!-- akhir read riwayat pendidikan -->

    <!-- bagian read achievement -->
    <h2 class="h3 mt-5">Pencapaian</h2>
    @if ($user->achievements->isNotEmpty())

        <div class="mb-3">

            @foreach($user->achievements as $achi)
                <div class="d-flex align-items-center justify-content-between">
                    <h5>Pencapaian {{$i += 1}}</h5>
                    <a id="tombolUbahAchievements" data-bs-toggle="modal" data-bs-target="#pencapaianModal" data-id="{{$achi->id}}" data-user_id="{{Auth::user()->id}}" data-description="{{$achi->description}}" data-bs-whatever="@getbootstrap"><i class="bi bi-pencil-fill align-bottom"></i></a>
                </div>

                <div class="col-12">
                    {!!$achi->description!!}
                </div>
            @endforeach

        </div>
    @else
        <p class="text-danger">Pencapaian belum dimasukan.</p>
    @endif

    <button type="button" class="btn btn-outline-primary" id="tombolTambahAchievements" data-bs-toggle="modal" data-id="" data-user_id="{{Auth::user()->id}}" data-description="" data-bs-target="#pencapaianModal"  data-bs-whatever="@getbootstrap">
        <i class="bi bi-plus-circle align-bottom"></i>Tambah
    </button>
    <!-- akhir read achievements -->

    <!-- bagian read experience -->
    <h2 class="h3 mt-5">Pengalaman</h2>
    @if ($user->experience->isNotEmpty())
    <table class="table table-striped table-sm">
        <tr>
            <th>Institusi</th>
            <th>Posisi</th>
            <th>Rincian</th>
        </tr>
        @foreach ($user->experience as $exp)
                <tr class="">
                    <td>{{$exp->institution}}</td>
                    <td>{{$exp->position}}</td>
                    <td><a class="btn btn-primary rounded-pill" id="tombolUbahExp" data-bs-toggle="modal" data-bs-target="#pengalamanModal" data-id="{{$exp->id}}" data-institution="{{$exp->institution}}" data-user_id="{{Auth::user()->id}}" data-posisi="{{$exp->position}}"data-bs-whatever="@getbootstrap"><i class="bi bi-eye-fill align-bottom"></i></a></td>
                </tr>
        @endforeach
    </table>
    @else
        <p class="text-danger">Pengalaman belum dimasukan.</p>
    @endif

    <button type="button" class="btn btn-outline-primary" id="tombolTambahExp" data-bs-toggle="modal" data-id="" data-user_id="{{Auth::user()->id}}" data-instansi="" data-posisi="" data-bs-target="#pengalamanModal"  data-bs-whatever="@getbootstrap">
        <i class="bi bi-plus-circle align-bottom"></i>Tambah
    </button>
    <!-- akhir read experience -->

    <!-- bagian box modal riwayat pendidikan -->
        <div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Riwayat Pendidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="ubahForm" method="POST" class="d-flex flex-column">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="hidden" name="user_education_id" id="user_education_id">
                            <div class="mb-3">
                                <label class="visually-hidden" for="roleSelect">Peran</label>
                                <select class="form-select" id="roleSelect" name="education_id" required>
                                    <option selected value="" disabled>Silahkan pilih jenjang pendidikan</option>
                                    @foreach ($education as $edu)
                                        <option value="{{ $edu->id }}">{{ $edu->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="institution" class="form-control" placeholder="Nama Instansi/Nama Sekolah" id="institution" required>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <input type="text" name="from_year" class="form-control" placeholder="Dari tahun/Angkatan" id="from_year" required>
                                </div>

                                <div class="col-md-6"><input type="text" name="to_year" class="form-control" placeholder="Sampai tahun/Alumni" id="to_year" required></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{route('account.delete-education')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" id="id_delete" value="">
                            <input type="hidden" name="user_education_id" id="id_edu_delete" value="">
                            <button class="btn btn-danger hapus">Hapus</button>
                            <button type="submit" form="ubahForm" class="btn btn-success">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir box modal riwayat pendidikan -->

        <!-- bagian box modal pencapaian -->
        <div class="modal fade" id="pencapaianModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pencapaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="pencapaianForm" method="POST" class="d-flex flex-column">
                            @csrf
                            <input type="hidden" name="user_id" id="userAchievementsId" value="">
                            <input type="hidden" name="id_achievements" id="idAchievements" value="">
                            <div class="mb-3">
                                <textarea id="editor" cols="5" name="deskripsi">
                                    
                                </textarea>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{route('account.delete-achievements')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" id="deleteUserIdAchievements" value="">
                            <input type="hidden" name="id_achievements" id="deleteIdAchievements" value="">
                            <button class="btn btn-danger hapus">Hapus</button>
                            <button type="submit" form="pencapaianForm" class="btn btn-success">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir box modal pencapaian -->

        <!-- bagian box modal riwayat pendidikan -->
        <div class="modal fade" id="pengalamanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengalaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="pengalamanForm" method="POST" class="d-flex flex-column">
                            @csrf
                            <input type="hidden" name="user_id" id="user_exp_id">
                            <input type="hidden" name="exp_id" id="exp_id">

                            <div class="mb-3">
                                <input type="text" name="institution" class="form-control" placeholder="Nama Instansi" id="expInstitution" required>
                            </div>

                            <div class="mb-3">
                                <input type="text" name="position" class="form-control" placeholder="Posisi Jabatan" id="posisi" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{route('account.delete-education')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" id="id_exp_delete" value="">
                            <input type="hidden" name="exp_id_delete" id="id_exp_delete" value="">
                            <button class="btn btn-danger hapus">Hapus</button>
                            <button type="submit" form="pengalamanForm" class="btn btn-success">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir box modal riwayat pendidikan -->

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile {{$user->name}}</h1>
    </div>

    

    @include('system.users._form')
@endsection