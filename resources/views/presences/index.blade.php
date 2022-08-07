@extends('layouts.main')
@section('title', 'Presensi')

@section('main')
    <div class="row">
        <div class="col-md-4 d-grid gap-2 pt-1">
            <button class="btn btn-primary btn-lg btn-block mt-md-5" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
                <i class="bi bi-qr-code"></i>
                Pindai QR
            </button>

            <button class="btn btn-light btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#passKeyFormModal">Masukkan
                Kode</button>

        </div>
        <div class="col-md-8">
            <h3 class="mt-3 h4">Akan Datang</h3>

            @if ($upcomingMeetings->count())
                @include('presences.components._upcomingMeetingsDiv')
            @else
                @include('layouts.components.alert', [
                    'class' => 'success',
                    'message' => 'Anda bisa bersantai🎉. belum ada agenda yang akan datang.',
                ])
            @endif

        </div>
    </div>


    <div class="d-flex align-items-center pt-3 pb-2 mb-3 mt-5">
        <h3 class="h4">Semua Agenda</h3>
        <button class="btn btn-success mx-4" data-bs-toggle="modal" data-bs-target="#meetingModal">Buat Agenda</button>
    </div>

    @if ($allMeetings->count())
        @include('presences.components._meetingsTableDiv', ['mettings' => $allMeetings])
    @else
        @include('layouts.components.alert', [
            'class' => 'warning',
            'message' =>
                'Anda belum memiliki agenda. silahkan hubungi penyelenggara agenda atau <a href="#">buat agenda baru</a> anda.',
        ])
    @endif


    @include('presences.components._meetingFormModal')

    @include('presences.components._meetingAttendancesModal')

    @include('presences.components._passKeyFormModal')

    @include('presences.components._qrScannerModal')

@endsection
