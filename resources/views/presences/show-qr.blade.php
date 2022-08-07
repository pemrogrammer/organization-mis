<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Kode Presensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>


    <div class="d-flex flex-column min-vh-100 align-items-center justify-content-center">

        <main>
            <h1 class="mb-5 text-break fw-normal fs-2">{{ $meeting->name }}</h1>

            <div id="qrcode"></div>
            <p class="mt-4 mb-0 fs-5">Kode Presensi:</p>
            <p class="h1">{{ $meeting->pass_key }}</p>
        </main>

        <footer class="d-flex flex-column align-items-center">

            <p class="mt-5 mb-3 text-muted">Klub Pemrograman TI POLNES &copy; 2022</p>
        </footer>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script type="text/javascript">
        new QRCode(document.getElementById("qrcode"), '{{ route("presences.update-attendance", ['pass_key' => $meeting->pass_key]) }}');
    </script>
</body>

</html>
