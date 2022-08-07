<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Pukul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Nama</th>
                <th scope="col">Tempat</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Kehadiran</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mettings as $meeting)
                @php
                    $disabledClass = $meeting->is_at_toleranced ? '' : 'disabled';
                @endphp
                <tr class="{{ $meeting->is_at_toleranced ? '' : 'text-muted' }}">
                    <td>{{ $meeting->at->toDateString() }}</td>
                    <td>{{ $meeting->at->format('H:i') }}</td>
                    <td>{{ $meeting->category }}</td>
                    <td>{{ $meeting->name }}</td>
                    <td>
                        @if (filter_var($meeting->location, FILTER_VALIDATE_URL))
                            <a href="{{ $meeting->location }}"
                                class="{{ $meeting->is_at_toleranced ? '' : 'text-muted' }}">{{ $meeting->location }}</a>
                        @else
                            {{ $meeting->location }}
                        @endif
                    </td>
                    <td>{{ $meeting->description }}</td>
                    <td>
                      @if($meeting->created_by_user_id === $user->id)
                      {{ $meeting->n_attend->count() }}/{{ $meeting->attendances->count() }}
                      @else
                      {{ $meeting->attendances->first(function ($attendance, $key) use ($user) {
                        return $attendance->user_id === $user->id;
                    })->attended_at_from_meeting_at_diff_for_humans; }}
                      @endif
                    </td>
                    <td>
                        @if ($meeting->created_by_user_id === $user->id || $user->is_admin)
                            <button class="btn btn-link {{ $disabledClass }}" {{ $disabledClass }}
                                onclick="setFormValue({{ $meeting->id }})" data-bs-toggle="tooltip"
                                data-bs-title="Ubah Agenda">
                                <i class="bi bi-pencil-fill fs-4"></i>
                            </button>

                            <button class="btn btn-link {{ $disabledClass }}" {{ $disabledClass }} target="popup"
                                onclick="showQrPage('{{ route('presences.show-qr', $meeting->id) }}')"
                                data-bs-toggle="tooltip" data-bs-title="Tampilkan Kode Presensi">
                                <i class="bi bi-qr-code fs-4"></i>
                            </button>

                            <button class="btn btn-link"
                                onclick="renderAttendacesTable({{ $meeting->id }})"
                                data-bs-toggle="tooltip" data-bs-title="Lihat Daftar Hadir">
                                <i class="bi bi-people-fill fs-4"></i>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!! $mettings->links() !!}
