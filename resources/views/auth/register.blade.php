<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register</title>

    <!-- Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #F6F7F8">
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-dark text-center">
                            <h2>Register</h2>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div>
                                    <label class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" required>
                                </div>
                                <div>
                                    <label class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div>
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
                                <div>
                                    <label class="mb-1">Status</label>
                                    <select class="mb-3 form-select" name="status" required>
                                        <option value="engineer">Engineer</option>
                                        <option value="engineer koordinator">Engineer Koordinator</option>
                                    </select>
                                </div>
                                <a class="text-secondary" href="{{ route('login') }}">Sudah punya akun?</a><br>
                                <button class="btn btn-primary mt-3" type="submit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>