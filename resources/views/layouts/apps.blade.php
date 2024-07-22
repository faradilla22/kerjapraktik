<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #F6F7F8">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand text-primary" href="{{ url('/') }}">
                </a> -->
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                </div> -->

            </div>
        </nav>

        <div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <!-- Left Sidebar -->
                <nav class="col-md-3 col-lg-2 d-md-block sidebar bg-white collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <!-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                                    <img src="{{ asset('image/pusri.webp') }}" alt="Logo Pusri" style="height: 40px;">
                                </a>
                            </li> -->
                            <li class="nav-item"><a class="nav-link link-dark small" href="#">ECR Static Equipment</a></li>
                            <li class="nav-item"><a class="nav-link link-dark small" href="#">Summary ECR</a></li>
                            <li class="nav-item"><a class="nav-link link-dark small" href="#">ECR P1B</a></li>
                            <li class="nav-item"><a class="nav-link link-dark small" href="#">ECR P2B</a></li>
                            <li class="nav-item"><a class="nav-link link-dark small" href="#">ECR P3</a></li>
                            <li class="nav-item"><a class="nav-link link-dark small" href="#">ECR P4</a></li>
                            <li class="nav-item"><a class="nav-link link-dark small" href="{{ route('bobots.index') }}">Setting ECR</a></li>
                            <li class="nav-item"><a class="nav-link link-danger small" href="{{ route('login') }}">Logout</a></li>
                        </ul>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>