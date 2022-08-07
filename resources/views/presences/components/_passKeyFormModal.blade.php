<div class="modal hide fade" tabindex="-1" id="passKeyFormModal" aria-labelledby="passKeyFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passKeyFormModalTitle">Masukkan Kode Presensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('presences.update-attendance') }}" id="passKeyForm">
                    <div class="form-floating mb-3">
                        <input name="pass_key" id="pass_key" class="form-control fs-3 pt-5 pb-5"
                            placeholder="Kode Presensi">
                        <label for="pass_key">Kode Presensi</label>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="passKeyForm" class="btn btn-success">Kirim</button>
            </div>
        </div>
    </div>
</div>
