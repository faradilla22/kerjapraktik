@extends('layouts.apps')

@section('content')
<title>@section('title','Setting ECR')</title>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 row">
                <div>
                    <h3 class="text-center my-4">Setting ECR</h3>
                    <hr>
                </div>


                <div class="col-md-2">
                    <nav id="sidebarMenu" class="d-md-block bg-light sidebar collapse">
                        <div class="position-sticky pt-3">
                            <ul class="nav flex-column">
    
                                <li class="mb-1"> <a href="#" class="text-decoration-none">
                                    <button class="btn btn-outline-primary btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#0d6efd"  stroke-width="1.75"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folders me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" /><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2" /></svg>
                                    ECR Static Equipment
                                    </button></a>


                                    <form id="values-form2" method="GET" action="{{ route('update-values4') }}">
                                        @csrf
                                        <input type="hidden" name="a" id="input-a" value="{{ session('a',1) }}">
                                        <input type="hidden" name="b" id="input-b" value="{{ session('b',1) }}">
                                    </form>

                                    <div class="collapse" id="orders-collapse">
                                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                            <!-- Item Summary ECR akan selalu aktif -->
                                            <li><a href="{{ route('summary.index') }}" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle">- Summary ECR</a></li>
                                            
                                            <!-- Item lain hanya aktif jika `session('a', 1)` sesuai dengan nilai yang diberikan -->
                                            <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle" onclick="updateValues4(1, {{ session('b', 1) }})">- ECR P1B</a></li>
                                            <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle " onclick="updateValues4(2, {{ session('b', 1) }})">- ECR P2B</a></li>
                                            <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle " onclick="updateValues4(3, {{ session('b', 1) }})">- ECR P3</a></li>
                                            <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle " onclick="updateValues4(4, {{ session('b', 1) }})">- ECR P4</a></li>
                                            <li><a href="{{ route('bobots.index') }}" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle active">- Setting ECR</a></li>

                                        </ul>
                                    </div>
                                </li>
                               
                            </ul>
                        </div>
                    </nav>
                </div>


                <div class="col-md-10 card border-0 shadow-sm rounded">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-sm w-50 ">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Bobot</th>
                                    <th scope="col">Nilai Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bobots as $bobot)
                                    <tr>
                                        <td>{{ $bobot->nama_bobot }}</td>
                                        <td>{{ $bobot->nilai_bobot }}</td>
                                       
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Bobot belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $bobots->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
                            
                        
        function updateValues4(a, b) {
            document.getElementById('input-a').value = a;
            document.getElementById('input-b').value = b;
            document.getElementById('values-form2').submit();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection