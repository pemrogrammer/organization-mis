<div class="modal fade" tabindex="-1" id="meetingModal" aria-hidden="true" aria-labelledby="meetingModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="meetingModalLabel">Buat Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('presences.store') }}" id="meetingForm" method="POST">

                    @csrf
                    <input type="hidden" id="meeting_id" name="meeting_id">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                            required>
                        <label for="name">Nama*</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="location" name="location"
                            placeholder="location">
                        <label for="name">Tempat</label>
                        <small class="form-text text-muted">
                            **dapat diisi link (Google Maps / Zoom)
                        </small>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" id="at" name="at" placeholder="at"
                            required>
                        <label for="at">Pada Tanggal-Pukul*</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="description"></textarea>
                        <label for="description">Deskripsi</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="category" name="category"
                            placeholder="category">
                        <label for="category">Ketegori</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="meetingForm" id="meetingFormSubmitButton" class="btn btn-success">Buat
                    Agenda</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        const PROCESS_RESULT_FUN = data => {
            const results = data.data.map(user => {
                return {
                    id: user.id,
                    text: user.name + (user.id_number ? "(" + user.id_number + ")" : "")
                }
            });

            return {
                results: results
            };
        }

        const SELECT2_AJAX = {
            url: '{{ route('json.users.get') }}',
            dataType: 'json',
            processResults: PROCESS_RESULT_FUN
        };

        $('#usersSelect').select2({
            multiple: true,
            minimumInputLength: 4,
            dropdownParent: $("#meetingAttendancesModalTitle"),
            cache: true,
            ajax: SELECT2_AJAX
        });

        function showQrPage(url) {
            var popup = window.open(url, "popup", "fullscreen");
            if (popup.outerWidth < screen.availWidth || popup.outerHeight < screen.availHeight) {
                popup.moveTo(0, 0);
                popup.resizeTo(screen.availWidth, screen.availHeight);
            }
        }

        function resetMeetingForm() {
            formEl.find('#meeting_id').val(null);
            formEl.find('#name').val(null);
            formEl.find('#location').val('');
            formEl.find('#at').val('');
            formEl.find('#description').val('');
            formEl.find('#category').val('');
            $('#meetingFormSubmitButton').html('Buat Agenda');
        }

        function setFormValue(meetingId) {
            const formEl = $('#meetingForm');
            const meeting = getMeeting(meetingId);
            $('#meetingModal').modal('show')

            if (meetingId) {
                $('#meetingModalLabel').html('Ubah Agenda ' + meeting.name);
                formEl.find('#meeting_id').val(meetingId);
                formEl.find('#name').val(meeting.name);
                formEl.find('#location').val(meeting.location);
                formEl.find('#at').val(meeting.datetime_local_at);
                formEl.find('#description').val(meeting.description);
                formEl.find('#category').val(meeting.category);
                $('#meetingFormSubmitButton').html('Simpan Perubahan');
            } else {
                $('#meetingModalLabel').html('Buat Agenda');
                resetMeetingForm();
            }
        }
    </script>
@endpush
