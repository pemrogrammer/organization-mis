<!doctype html>
<html lang="en">

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

    <!-- Custom styles for this template -->
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: 0px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">

    <main class="form-signin w-100 m-auto">
        <h1 class="h4 fw-normal @sectionMissing('title') mb-5 @endif ">{{ config('app.name') }}</h1>

        @hasSection('title')
            <h2 class="mb-5 fw-normal">@yield('title')</h2>
        @endif

        @includeWhen(Session::has('status'), 'layouts.components.alert', [
            'class' => 'success',
            'message' => Session::get('status'),
        ])

        @if ($errors->any())
            @foreach ($errors->all() as $message)
                @include('layouts.components.alert', [
                    'class' => 'danger',
                    'message' => $message,
                ])
            @endforeach
        @endif

        @yield('main')
    </main>

</body>

</html>
