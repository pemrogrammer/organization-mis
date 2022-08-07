<div class="modal fade" tabindex="-1" id="meetingAttendancesModal" aria-labelledby="meetingAttendancesModalTitle"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetingAttendancesModalTitle">Daftar Hadir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('presences.store-attendances') }}" id="attendancesForm" method="POST">

                    @csrf

                    <input type="hidden" id="meeting_id" name="meeting_id">

                    <div class="mb-3">
                        <label for="usersSelect">Tambah Peserta: </label>
                        <select id="usersSelect" class="form-control" name="user_ids[]" style="width: 100%"
                            placeholder="Tulis nama peserta">
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" form="attendancesForm" class="btn btn-success">Masukkan
                            Peserta</button>

                    </div>

                </form>

                <div class="table-responsive">
                    <table class="table table-striped" id="attendancesTable">
                        <thead>
                            <tr>
                                <th scope="col">Nomor Induk</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Hadir</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        const meetings = [].concat({{ Js::from($upcomingMeetings->toJson()) }}, {{ Js::from($allMeetings->items()) }});

        function getMeeting(meetingId) {
            return meetings.find(meeting => meeting.id == meetingId)
        }

        function renderAttendacesTable(meetingId) {
            const tableEl = $('#attendancesTable');
            const meeting = getMeeting(meetingId);
            const formEl = $('#attendancesForm');
            formEl.find('#meeting_id').val(meetingId);

            if (meeting.is_at_toleranced) {
                formEl.children().prop("disabled", false);
                formEl.children().removeClass("disabled");
                formEl.find('button').removeClass("disabled");
                formEl.removeClass("d-none");
            } else {
                formEl.children().prop("disabled", true);
                formEl.children().addClass("disabled");
                formEl.find('button').addClass("disabled");
                formEl.addClass("d-none");
            }


            let tbody = `<tr>
        <td colspan="4" class="text-center">Belum ada peserta</td>
        </tr>`;


            if (meeting?.attendances.length > 0) {
                tbody = meeting?.attendances.map(attendance => {
                    return `<tr>
                <td>${attendance.user.id_number || ''}</td>
                <td>${attendance.user.name}</td>
                <td>${attendance.attended_at ? attendance.attended_at_from_meeting_at_diff_for_humans : '-'}</td>
                <td></td>
              </tr>`;
                });
            }



            tableEl.children('tbody').html(tbody);

            $('#meetingAttendancesModal').modal('show');
        }
    </script>
@endpush
