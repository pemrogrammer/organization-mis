<div class="modal hide fade" tabindex="-1" id="qrScannerModal" aria-labelledby="qrScannerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrScannerModalTitle">Arahkan ke kode QR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('layouts.components.alert', [
                    'class' => 'warning',
                    'message' => 'Sedang memuat kamera, mohon menunggu',
                ])
                <div class="d-flex justify-content-center">
                    <div id="scannerPreviewContainer" class="ratio ratio-1x1 overflow-hidden mx-5">
                        <div>
                            <div class="d-flex justify-content-center" style="width: 100%; height: 100%;">
                                <i class="bi bi-camera-video-off" style="font-size: 6em"></i>
                                <video id="preview" class="d-none"></video>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-link" onclick="switchCamera()" data-bs-toggle="tooltip"
                    data-bs-title="Ganti Camera">
                    <i class="bi bi-phone-flip fs-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
        integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ URL::asset('assets/js/instascan.min.js') }}"></script>

    <script type="text/javascript">
        let scanner = null;
        let camera_devices = null;
        let qrScannerModal = null;
        let qrScannerModalAlert = null;

        $(function() {
            qrScannerModal = $('#qrScannerModal');
            qrScannerModalAlert = qrScannerModal.find('[role="alert"]');

            qrScannerModal.on('hidden.bs.modal', hideQrScannerModal);
            qrScannerModal.on('shown.bs.modal', showQrScannerModal);
        });

        function showQrScannerModal() {
            if (!scanner) {
                initInstascan();
            } else {
                startCamera(localStorage.getItem("lastCameraId"));
            }
        }

        function hideQrScannerModal() {
            scanner.stop();
        }

        function isMirrorCamera(cameraName) {
            const mirrorCameraNames = ['front', 'webcam'];
            return mirrorCameraNames.some(name => cameraName.toLowerCase().includes(name));
        }

        function startCamera(cameraId) {
            localStorage.setItem("lastCameraId", cameraId);

            const cameraActive = camera_devices[cameraId];
            scanner.mirror = isMirrorCamera(cameraActive.name);
            scanner.start(cameraActive).then().catch(e => setQrScannerModalAlert('Gagal memuat kamera. error: ' + e.message,
                'danger'));
        }

        function switchCamera() {
            scanner.stop();

            let activeCameraId = parseInt(localStorage.getItem("lastCameraId"));

            if (activeCameraId == camera_devices.length - 1) {
                activeCameraId = 0;
            } else {
                activeCameraId++;
            }

            startCamera(activeCameraId)
        }

        function isContentValid(string) {
            let url;

            try {
                url = new URL(string);
            } catch (_) {
                return false;
            }

            return url.protocol + '//' + url.host === '{{ url('/') }}';
        }

        function initInstascan() {
            const container = qrScannerModal.find('#scannerPreviewContainer');
            const video = qrScannerModal.find('video');

            scanner = new Instascan.Scanner({
                video: document.getElementById('preview')
            });

            scanner.addListener('scan', function(content) {
                if (isContentValid(content)) {
                    window.location.replace(content);
                } else {
                    setQrScannerModalAlert('Kode QR tidak valid, silahkan coba lagi.', 'danger');
                }
            });

            scanner.addListener('active', function(content) {
                container.find('i').addClass('d-none');
                video.removeClass('d-none');
                setQrScannerModalAlert('Silahkan arahkan kamera pada kode QR', 'success')
            });

            scanner.addListener('inactive', function(content) {
                container.find('i').removeClass('d-none');
                video.addClass('d-none');
                setQrScannerModalAlert('Sedang memuat kamera, mohon menunggu', 'warning')

            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    camera_devices = cameras;
                    startCamera(localStorage.getItem("lastCameraId"));
                } else {
                    setQrScannerModalAlert('Tidak dapat menemukan camera', 'danger');
                }
            }).catch(e => {
                if (e.message.includes('NotAllowedError')) {
                    setQrScannerModalAlert('Mohon izinkan akses kamera', 'danger');
                } else {
                    setQrScannerModalAlert('Error: ' + e.message, 'danger');
                }
            });
        }

        function setQrScannerModalAlert(message, clss) {

            qrScannerModalAlert.html(message);
            qrScannerModalAlert.removeClass();
            qrScannerModalAlert.addClass('alert alert-' + clss);

            if (clss === 'danger') {
                qrScannerModalAlert.effect("shake", {
                    direction: "left",
                    times: 3,
                    distance: 2
                });
            } else {
                qrScannerModalAlert.effect("shake", {
                    direction: "up",
                    times: 1,
                    distance: 2
                });
            }
        }
    </script>
@endpush
