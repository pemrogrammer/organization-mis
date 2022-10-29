<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>
        {{ config('app.name') }}
        @hasSection('title')
            - @yield('title')
        @endif
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .badge button {
            color: inherit;
            border: 0px;
            padding: .5px 3px;
            margin-left: .1em;
        }

        .badge button:hover {
            color: initial;
            background-color: white;
        }

        .badge {
            font-size: 1em;
            padding-left: 1em;
        }
    </style>


    <!-- Custom styles for this template -->
    <style>
        /* body {
            font-size: .875rem;
        } */

        .feather {
            width: 16px;
            height: 16px;
        }

        /*
 * Sidebar
 */

        .sidebar {
            position: fixed;
            top: 0;
            /*
            rtl:raw:
            right: 0;
            */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100;
            /* Behind the navbar */
            padding: 48px 0 0;
            /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
            }
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #727272;
        }

        .sidebar .nav-link.active {
            color: #2470dc;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }

        .sidebar-heading {
            font-size: .75rem;
        }

        /*
 * Navbar
 */

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }

        .navbar .form-control {
            padding: .75rem 1rem;
        }

        .form-control-dark {
            color: #fff;
            background-color: rgba(255, 255, 255, .1);
            border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }
    </style>


    @push('styles')
    @method('styles')
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
            aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link nav-link px-3 d-flex" type="submit">
                        Log Out <span class="bi-box-arrow-right" style="margin-left: .7rem" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            @include('layouts.components.sidebar')

            {{-- <div class="p-3 border-top position-absolute" style="bottom: 0px; left: 0px; z-index: 100;">
                <p class="m-0">Klub Pemrograman TI POLNES</p>
                <p class="m-0">Copyright © 2022</p>
            </div> --}}

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5">
              <div class="m-md-5">

                @if (Session::has('alerts'))
                    @foreach (Session::get('alerts') as $alert)
                        @include('layouts.components.alert', [
                            'class' => $alert['class'] . ' mt-3 mb-0',
                            'message' => $alert['message'],
                        ])
                    @endforeach
                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $message)
                        @include('layouts.components.alert', [
                            'class' => 'danger mt-3 mb-0',
                            'message' => $message,
                        ])
                    @endforeach
                @endif


                <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('title')</h1>

                    @hasSection('btn-toolbar')
                        <div class="btn-toolbar mb-2 mb-md-0">
                            @yield('btn-toolbar')
                        </div>
                    @endif
                </div>

                  @yield('main')
              </div>

            </main>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        async function select2Init() {
          const jsonURL =
            "https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/regencies.json";

          const res = await fetch(jsonURL);
          const cities = await res.json();

          const select2Data = cities.map(city => {
            return {
              id: city.id,
              text: city.name
            }
          })

          $("#addressCity1").select2({
            data: select2Data
          });

          $("#addressCity2").select2({
            data: select2Data
          });
        }

        select2Init();
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

    @yield('scripts')
    @stack('scripts')
</body>

</html>
