<div class="row" style="overflow-x: scroll">
    @foreach ($upcomingMeetings as $meeting)
        <div class="col-md-4">
            <div class="card mb-3">

                <div class="card-header">
                    @if ($meeting->category)
                        <p class="mb-0">
                            <b>{{ $meeting->category }}</b>
                        </p>
                    @endif

                    <p class="mb-0">
                        <small>
                            {{ $meeting->at->diffForHumans() }}
                        </small>
                    </p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $meeting->name }}</h5>
                    <p class="card-text">
                        {{ $meeting->description }}
                    </p>

                    @if ($meeting->location)
                        <p class="mb-0">
                            <i class="bi bi-pin-map-fill mx-1 text-danger"></i>

                            @if (filter_var($meeting->location, FILTER_VALIDATE_URL))
                                <a href="{{ $meeting->location }}">{{ $meeting->location }}</a>
                            @else
                                {{ $meeting->location }}
                            @endif
                        </p>
                    @endif
                    <p class="mb-0">
                        <i class="bi bi-calendar-date mx-1"></i>
                        {{ $meeting->at->toFormattedDateString() }}
                    </p>

                    <p>
                        <i class="bi bi-clock mx-1"></i>
                        {{ $meeting->at->format('H:i') }}
                    </p>


                </div>
                @if ($meeting->created_by_user_id === $user->id)
                    <div class="card-footer d-flex justify-content-around">
                        <button class="btn btn-link" onclick="setFormValue({{ $meeting->id }})"
                            data-bs-toggle="tooltip" data-bs-title="Ubah Agenda">
                            <i class="bi bi-pencil-fill fs-4"></i>
                        </button>

                        <button class="btn btn-link" target="popup"
                            onclick="showQrPage('{{ route('presences.show-qr', $meeting->id) }}')"
                            data-bs-toggle="tooltip" data-bs-title="Tampilkan Kode Presensi">
                            <i class="bi bi-qr-code fs-4"></i>
                        </button>

                        <button class="btn btn-link" onclick="renderAttendacesTable({{ $meeting->id }})"
                            data-bs-toggle="tooltip" data-bs-title="Lihat Daftar Hadir">
                            <i class="bi bi-people-fill fs-4"></i>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
