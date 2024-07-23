@extends('layouts.apps')

@section('content')
<title>@section('title','Datatable Engineer')</title>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Judul</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    

                    

                    <div class="card-body table-responsive">
                        <p>Last Reported : </p>
                        <table class="table table-bordered table-sm w-50 ">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Nama Bobot</th>
                                    <th scope="col">Nilai Bobot</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="bobotTableBody">
                                @forelse ($bobots as $bobot)
                                    <tr data-id="{{ $bobot->id }}">
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

                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahItemModal">
                        History Report
                        </button>

                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahItemModal">
                        Terbitkan Report
                        </button>
                        <table class="table table-bordered table-sm w-70 " id="myTable">
                            <thead>
                                <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Last Updated</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Item No.</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">S</th>
                                    <th scope="col">L</th>
                                    <th scope="col">P</th>
                                    <th scope="col">E</th>
                                    <th scope="col">B</th>
                                    <th scope="col">H</th>
                                    <th scope="col">ECR</th>
                                    <th scope="col">R</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">Action</th>



                                </tr>
                            </thead>
                            <tbody id="itemTableBody">
                            <tbody id="itemTableBody">
                                @forelse ($item as $items)
                                    <tr data-id="{{ $items->id }}">
                                        <td> </td>
                                        <td>{{$items->updated_at}}</td>
                                    <tr data-id="{{ $items->id }}">
                                        <td> </td>
                                        <td>{{$items->updated_at}}</td>
                                        <td>{{ $items->status }}</td>
                                        <td>{{ $items->item_no }}</td>
                                        <td>{{ $items->item_name }}</td>
                                        <td>{{ $items->S }}</td>
                                        <td>{{ $items->L }}</td>
                                        <td>{{ $items->P }}</td>
                                        <td>{{ $items->E }}</td>
                                        <td>{{ $items->B }}</td>
                                        <td>{{ $items->H }}</td>
                                        <td class="ecr-value">{{ $items->ECR }}</td>
                                        <td class="ecr-value">{{ $items->ECR }}</td>
                                        <td>{{ $items->R }}</td>
                                        <td class="rr-value">{{ $items->RR }}</td>
                                        <td class="rr-value">{{ $items->RR }}</td>
                                        <td>
                                        <a href="#" class="btn btn-md btn-primary mb-3" onclick="calculateAndSave({{ $items->id }})">Calculate</a>
                                        <a href="#" class="btn btn-md btn-primary mb-3" onclick="calculateAndSave({{ $items->id }})">Calculate</a>
                                        <a href="#" class="btn btn-md btn-success mb-3">Approve</a>
                                        <a href="#" class="btn btn-md btn-danger mb-3">Reject</a>
                                        
                                        
                                        <!-- <a href="#" class="btn btn-md btn-success mb-3">Edit/a>
                                        <a href="#" class="btn btn-md btn-danger mb-3">Hapus</a> -->
                                        
                                        
                                        
                                        <!-- <a href="#" class="btn btn-md btn-success mb-3">Edit/a>
                                        <a href="#" class="btn btn-md btn-danger mb-3">Hapus</a> -->
                                        
                                        <a href="#" class="btn btn-md btn-warning text-white mb-3">Trend</a>
                                        </td>

                                       
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Item belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>

                        <script>
                            function calculateAndSave(itemId) {
                                // Get the item row
                                const row = document.querySelector(`tr[data-id="${itemId}"]`);
                                const s = parseFloat(row.querySelector('td:nth-child(6)').innerText);
                                const l = parseFloat(row.querySelector('td:nth-child(7)').innerText);
                                const p = parseFloat(row.querySelector('td:nth-child(8)').innerText);
                                const e = parseFloat(row.querySelector('td:nth-child(9)').innerText);
                                const b = parseFloat(row.querySelector('td:nth-child(10)').innerText);
                                const h = parseFloat(row.querySelector('td:nth-child(11)').innerText);
                                const r = parseFloat(row.querySelector('td:nth-child(13)').innerText);

                                // Calculate ECR
                                let ecr = 0;
                                document.querySelectorAll('#bobotTableBody tr').forEach(bobotRow => {
                                    const bobot = parseFloat(bobotRow.querySelector('td:nth-child(2)').innerText);
                                    ecr += (s * bobot) + (l * bobot) + (p * bobot) + (e * bobot) + (b * bobot) + (h * bobot);
                                });

                                // Calculate RR
                                const rr = ecr * r;

                                // Set the values in the table
                                row.querySelector('.ecr-value').innerText = ecr.toFixed(2);
                                row.querySelector('.rr-value').innerText = rr.toFixed(2);

                                // Save the values to the database
                                fetch(`/items/${itemId}/update`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        ecr: ecr,
                                        rr: rr
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'ECR and RR values updated successfully!',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while updating the values.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            }
                        </script>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
                                for (var i = 0; i < table.rows.length; i++) {
                                    table.rows[i].cells[0].innerHTML = i + 1;
                                }
                            });
                        </script>

                        <script>
                            function calculateAndSave(itemId) {
                                // Get the item row
                                const row = document.querySelector(`tr[data-id="${itemId}"]`);
                                const s = parseFloat(row.querySelector('td:nth-child(6)').innerText);
                                const l = parseFloat(row.querySelector('td:nth-child(7)').innerText);
                                const p = parseFloat(row.querySelector('td:nth-child(8)').innerText);
                                const e = parseFloat(row.querySelector('td:nth-child(9)').innerText);
                                const b = parseFloat(row.querySelector('td:nth-child(10)').innerText);
                                const h = parseFloat(row.querySelector('td:nth-child(11)').innerText);
                                const r = parseFloat(row.querySelector('td:nth-child(13)').innerText);

                                // Calculate ECR
                                let ecr = 0;
                                document.querySelectorAll('#bobotTableBody tr').forEach(bobotRow => {
                                    const bobot = parseFloat(bobotRow.querySelector('td:nth-child(2)').innerText);
                                    ecr += (s * bobot) + (l * bobot) + (p * bobot) + (e * bobot) + (b * bobot) + (h * bobot);
                                });

                                // Calculate RR
                                const rr = ecr * r;

                                // Set the values in the table
                                row.querySelector('.ecr-value').innerText = ecr.toFixed(2);
                                row.querySelector('.rr-value').innerText = rr.toFixed(2);

                                // Save the values to the database
                                fetch(`/items/${itemId}/update`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        ecr: ecr,
                                        rr: rr
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'ECR and RR values updated successfully!',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while updating the values.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            }
                        </script>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
                                for (var i = 0; i < table.rows.length; i++) {
                                    table.rows[i].cells[0].innerHTML = i + 1;
                                }
                            });
                        </script>
                        {{ $item->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        //message with sweetalert
       /*  @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif */

    </script>

@endsection