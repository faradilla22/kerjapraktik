@extends('layouts.apps')

@section('content')
<title>@section('title','Moderasi Registrasi')</title>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">Menunggu Konfirmasi</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body table-responsive">
                <table class="table table-bordered table-sm w-70 " id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Status</th>
                            <th scope="col">Pabrik</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="itemTableBody">
                        @forelse ($penggunas as $pengguna)
                            <tr>
                                <td>{{ $pengguna->username }}</td>
                                <td>{{ $pengguna->status }}</td>
                                <form method="POST" action="{{ route('koordinator.penggunas.approve', $pengguna->id) }}">
                                    @csrf
                                    <td>
                                        <select class="form-select" name="id_pabrik">
                                            <option value="" selected disabled>Pilih pabrik</option>
                                            <option value="">None</option>
                                            @foreach ($pabriks as $pabrik)
                                                <option value="{{ $pabrik->id }}">{{ $pabrik->nama_pabrik }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Approve</button>
                                    </td>
                                </form>
                            </tr>

                        @empty
                            <div class="alert alert-danger">
                                Tidak ada permohonan registrasi.
                            </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@endsection