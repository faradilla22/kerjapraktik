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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .modal-body input, .modal-body textarea {
            width: 100%; /* Mengatur lebar input box menjadi 100% dari container */
            margin-bottom: 15px; /* Memberi jarak antar elemen */
        }
        .form-group {
            display: flex;
            align-items: center;
        }
        .form-group label {
            flex: 1;
            margin-bottom: 0; /* Menghilangkan margin bawah */
        }
        .form-group .input-group {
            flex: 1;
        }
        .multiple-inputs .form-group {
            flex: 1;
        }
        .multiple-inputs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 15px; /* Memberi jarak antar elemen */
        }
    </style>
</head>
<body style="background: #F6F7F8">
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-primary" href="#"> pakPTL
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                </div>

            </div>
        </nav>

        <div class="container-fluid d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <!-- Left Sidebar -->
                <nav class="col-md-3 col-lg-2 d-md-block sidebar bg-white collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    <img src="{{ asset('image/logopusri.png') }}" alt="Logo Pusri" style="height: 35px">
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link link-dark" href="#">ECR Static Equipment</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="#">Summary ECR</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('item.index') }}">ECR P1B</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="#">ECR P2B</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="#">ECR P3</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="#">ECR P4</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('bobots.index') }}">Setting ECR</a></li>
                            <li class="nav-item"><a class="nav-link link-dark" href="{{ route('koordinator.penggunas') }}">Moderasi Registrasi</a></li>
                            <li class="nav-item"><a class="nav-link link-danger" href="{{ route('login') }}">Logout</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>