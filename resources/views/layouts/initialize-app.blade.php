<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Initialize MIS Organization</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<style>
    .container {
        max-width: 576px;
    }
</style>

<body>

    <div class="container py-3">
        <header>
            <div class="p-3 pb-md-4 mx-auto text-center">
                <h1 class="h4">Inisialisasi Aplikasi</h1>
                <p class="text-muted">
                    Aplikasi MIS Organization memerlukan beberapa pengaturan awal untuk dapat berfungsi dengan baik.
                    silahkan lengkapi semua isian di bawah.
                </p>
            </div>
        </header>

        <p class="text-muted text-center">
            1/3
        </p>

        <h2 class="fw-normal text-center mb-4">Membuat Akun Administrator</h2>


        <div class="card mb-3">
            <div class="card-body">
                <p class="h6 card-subtitle mb-2 text-muted text-center">Daftar dengan:</p>


                <div class="text-center">
                    <a href="{{ route('initialize-app.sign-up-admin-with-google') }}" class="btn btn-link" data-bs-toggle="tooltip" data-bs-title="Google">
                        <i class="bi-google fs-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <p class="text-muted text-center">
            atau
        </p>


        <main>
            @yield('main')
        </main>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>
