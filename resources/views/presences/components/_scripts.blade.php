<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    const meetings = [].concat(JSON.parse('{!! $upcomingMeetings->toJson() !!}'), JSON.parse('{!! json_encode($allMeetings->items()) !!}'));

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
