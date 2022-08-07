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
                <button type="submit" form="meetingForm" id="meetingFormSubmitButton" class="btn btn-success">Buat Agenda</button>
            </div>
        </div>
    </div>
</div>
