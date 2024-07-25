<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Datatable koordinator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

        /* Optional: Custom styles for the modal */
        .modal-header {
            display: flex;
            justify-content: center;
            border-bottom: none;
        }

        .modal-footer {
            display: flex;
            justify-content: center;
            border-top: none;
        }

        .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>

</head>
<body style="background: lightgray">

                                    <!-- Form untuk mengirim nilai ke server -->
                                    <form id="values-form" method="GET" action="{{ route('update-values3') }}">
                                        @csrf
                                        <input type="hidden" name="a" id="input-a" value="{{ session('a',1) }}">
                                        <input type="hidden" name="b" id="input-b" value="{{ session('b',1) }}">
                                    </form>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 row">
                
                <div>
                    <h3 class="text-center my-4">JUDUL</h3>
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


                                    

                                    <div class="collapse" id="orders-collapse">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <li><a href="{{ route('summary.index') }}" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle">- Summary ECR</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 1 ? 'active' : '' }}" onclick="updateValues3(1, {{ session('b', 1) }})">- ECR P1B</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 2 ? 'active' : '' }}" onclick="updateValues3(2, {{ session('b', 1) }})">- ECR P2B</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 3 ? 'active' : '' }}" onclick="updateValues3(3, {{ session('b', 1) }})">- ECR P3</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 4 ? 'active' : '' }}" onclick="updateValues3(4, {{ session('b', 1) }})">- ECR P4</a></li>
                                        <li><a href="{{ route('bobots.index') }}" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle">- Setting ECR</a></li>

                                    </ul>
                                    </div>
                                </li>
                               
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-10 card border-0 shadow-sm rounded">
                    
                   

                        <div class="card-body table-responsive">
                            <button class="btn btn-outline-primary {{ session('b', 1) == 1 ? 'active' : '' }}" onclick="updateValues3({{ session('a', 1) }}, 1)">
                            {{--  {{ $bagian->nama_bagian }} --}} Amonia</button>
                                        
                            <button class="btn btn-outline-primary {{ session('b', 1) == 2 ? 'active' : '' }}" onclick="updateValues3({{ session('a', 1) }}, 2)">
                            {{-- {{ $bagian->nama_bagian }} --}} Urea</button>
                                
                            <button class="btn btn-outline-primary {{ session('b', 1) == 3 ? 'active' : '' }}" onclick="updateValues3({{ session('a', 1) }}, 3)">
                            {{-- {{ $bagian->nama_bagian }} --}} Utility</button>


                    

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

                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#historyReport">
                            History Report
                            </button>
                        
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#terbitkanReport">
                            Terbitkan Report
                            </button>

                          
                        </div>

                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                      
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
                                @foreach ($item as $items) 
                                @if (/* $items->id_pabrik==$a && $items->id_bagian==$b */ $items->id_pabrik == session('a', 1) && $items->id_bagian == session('b', 1)) 
            
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
                                        <td>{{ $items->R }}</td>
                                        <td class="rr-value">{{ $items->RR }}</td>
                                        <td>
                                        <a href="#" class="btn btn-md btn-primary mb-3" onclick="calculateAndSave({{ $items->id }})">Calculate</a>
                                        
                                        <!-- Button to Open Edit Modal -->
                                        <button type="button" class="btn btn-success mb-3" data-toggle="modal" onclick="openApproveModal({{ $items->id }}, '{{ $items->item_name }}')">
                                            Approve
                                        </button>

                                        <!-- Modal HTML -->
                                        <div class="modal fade" id="approveItemModal" tabindex="-1" aria-labelledby="approveItemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="approveItemModalLabel">Approve Item</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Approve <span id="itemTitle"></span></p>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="approveCheck">
                                                            <label class="form-check-label" for="approveCheck">Saya yakin ingin menyetujui ini</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" id="approveBtn" disabled>OK</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Button to Open Reject Modal -->
                                        <button type="button" class="btn btn-danger mb-3" data-toggle="modal" onclick="openRejectModal({{ $items->id }}, '{{ $items->item_name }}')">
                                            Reject
                                        </button>

                                        <!-- Modal HTML for Reject -->
                                        <div class="modal fade" id="rejectItemModal" tabindex="-1" aria-labelledby="rejectItemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectItemModalLabel">Reject Item</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Reject <span id="rejectItemTitle"></span></p>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="rejectCheck">
                                                            <label class="form-check-label" for="rejectCheck">Saya yakin ingin menolak ini</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" id="rejectBtn" disabled>OK</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                       {{--  <button type="button" class="btn btn-danger mb-3" data-toggle="modal" onclick="showRejectModal({{ $items->id }}, '{{ $items->item_name }}')">
                                            Reject
                                        </button> --}}

                                        <!-- Modal Reject -->
                                        {{-- <div class="modal fade" id="rejectItem" tabindex="-1" role="dialog" aria-labelledby="rejectItemLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="rejectItemLabel">Reject <span id="rejectItemName"></span></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="rejectForm">
                                                            <div class="form-group">
                                                                <input type="checkbox" id="rejectConfirm" required>
                                                                <label for="rejectConfirm">Saya yakin ingin menolak ini</label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" onclick="rejectItem()">OK</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        

                                        


                                        
                                        
                                        <!-- <a href="#" class="btn btn-md btn-success mb-3">Edit/a>
                                        <a href="#" class="btn btn-md btn-danger mb-3">Hapus</a> -->
                                        
                                        <a href="#" class="btn btn-md btn-warning text-white mb-3">Trend</a>
                                        </td>

                                       
                                    </tr>
                                
                                
                                   {{--  <div class="alert alert-danger">
                                        Data Item belum Tersedia.
                                    </div> --}}
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Modal Reject -->
                        <div class="modal fade" id="rejectItem" tabindex="-1" role="dialog" aria-labelledby="rejectItemLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectItemLabel">Reject <span id="rejectItemName"></span></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="rejectForm">
                                            <div class="form-group">
                                                <input type="checkbox" id="rejectConfirm" required>
                                                <label for="rejectConfirm">Saya yakin ingin menolak ini</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" onclick="rejectItem()">OK</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function updateValues3(a, b) {
                                document.getElementById('input-a').value = a;
                                document.getElementById('input-b').value = b;
                                document.getElementById('values-form').submit();
                            }
                        </script>
                        {{-- <script>

                        function calculateAndSave(itemId) {
                            // Get the item row
                            const row = document.querySelector(`tr[data-id="${itemId}"]`);
                            const s = parseFloat(row.querySelector('td:nth-child(6)').innerText);
                            const l = parseFloat(row.querySelector('td:nth-child(7)').innerText);
                            const p = parseFloat(row.querySelector('td:nth-child(8)').innerText);
                            const e = parseFloat(row.querySelector('td:nth-child(9)').innerText);
                            const b = parseFloat(row.querySelector('td:nth-child(10)').innerText);
                            const h = parseFloat(row.querySelector('td:nth-child(11)').innerText);

                            // Array to store bobot values
                            let bobotArray = [];

                            // Get bobot values from the table
                            document.querySelectorAll('#bobotTableBody tr').forEach(bobotRow => {
                                const bobot = parseFloat(bobotRow.querySelector('td:nth-child(2)').innerText);
                                bobotArray.push(bobot);
                            });

                            // Ensure the bobotArray has the correct number of elements
                            if (bobotArray.length !== 6) {
                                console.error('Bobot array does not have the correct number of elements.');
                                return;
                            }

                            // Calculate ECR
                            let ecr = (s * bobotArray[0]) + (l * bobotArray[1]) + (p * bobotArray[2]) + (e * bobotArray[3]) + (b * bobotArray[4]) + (h * bobotArray[5]);

                            // Update ECR value in the row
                            const ecrCell = row.querySelector('td:nth-child(12)');
                            if (ecrCell) {
                                ecrCell.innerText = ecr.toFixed(2); // Format to 2 decimal places
                            }

                            

                                const r = parseFloat(row.querySelector('td:nth-child(13)').innerText);

                                // Calculate RR
                                const rr = ecr * r;

                                // Set the values in the table
                                row.querySelector('.ecr-value').innerText = ecr.toFixed(2);
                                row.querySelector('.rr-value').innerText = rr.toFixed(2);

                                console.log('Sending request to update values', {
                                ecr: ecr,
                                rr: rr
                                });

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
                        </script> --}}

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

                        // Array to store bobot values
                        let bobotArray = [];

                        // Get bobot values from the table
                        document.querySelectorAll('#bobotTableBody tr').forEach(bobotRow => {
                            const bobot = parseFloat(bobotRow.querySelector('td:nth-child(2)').innerText);
                            bobotArray.push(bobot);
                        });

                        // Ensure the bobotArray has the correct number of elements
                        if (bobotArray.length !== 6) {
                            console.error('Bobot array does not have the correct number of elements.');
                            return;
                        }

                        // Calculate ECR
                        let ecr = (s * bobotArray[0]) + (l * bobotArray[1]) + (p * bobotArray[2]) + (e * bobotArray[3]) + (b * bobotArray[4]) + (h * bobotArray[5]);

                        // Update ECR value in the row
                        const ecrCell = row.querySelector('td:nth-child(12)');
                        if (ecrCell) {
                            ecrCell.innerText = ecr.toFixed(2); // Format to 2 decimal places
                        }

                        //function calculateAndSave(itemId) {
                        ////    // Get the item row
                        //    const row = document.querySelector(`tr[data-id="${itemId}"]`);
                        //    const s = parseFloat(row.querySelector('td:nth-child(6)').innerText);
                        //    const l = parseFloat(row.querySelector('td:nth-child(7)').innerText);
                        //    const p = parseFloat(row.querySelector('td:nth-child(8)').innerText);
                        //    const e = parseFloat(row.querySelector('td:nth-child(9)').innerText);
                        //    const b = parseFloat(row.querySelector('td:nth-child(10)').innerText);
                        //    const h = parseFloat(row.querySelector('td:nth-child(11)').innerText);
                    //
                            // Calculate ECR
                        //    let ecr = 0;
                        //    document.querySelectorAll('#bobotTableBody tr').forEach(bobotRow => {
                        //        const bobot = parseFloat(bobotRow.querySelector('td:nth-child(2)').innerText);
                        //        ecr += (s * bobot) + (l * bobot) + (p * bobot) + (e * bobot) + (b * bobot) + (h * bobot);
                        //    });

                            const r = parseFloat(row.querySelector('td:nth-child(13)').innerText);

                            // Calculate RR
                            const rr = ecr * r;

                            // Set the values in the table
                            row.querySelector('.ecr-value').innerText = ecr.toFixed(2);
                            row.querySelector('.rr-value').innerText = rr.toFixed(2);

                            console.log('Sending request to update values', {
                            ecr: ecr,
                            rr: rr
                            });

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

                        


                        {{-- <script>
                            let selectedItemId;

                            function openApproveModal(itemId, itemName) {
                                selectedItemId = itemId;
                                document.getElementById('itemTitle').innerText = itemName;
                                document.getElementById('approveCheck').checked = false;
                                document.getElementById('approveBtn').disabled = true;
                                $('#approveItemModal').modal('show');
                            }

                            document.getElementById('approveCheck').addEventListener('change', function() {
                                document.getElementById('approveBtn').disabled = !this.checked;
                            });

                            document.getElementById('approveBtn').addEventListener('click', function() {
                                fetch(`/item/${selectedItemId}/approve`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        status: 'Approved'
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Item approved successfully!',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'An error occurred while approving the item.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while approving the item.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            });
                        </script> --}}

                        <script>
                            let selectedItemId;
                        
                            function openApproveModal(itemId, itemName) {
                                selectedItemId = itemId;
                                document.getElementById('itemTitle').innerText = itemName;
                                document.getElementById('approveCheck').checked = false;
                                document.getElementById('approveBtn').disabled = true;
                                $('#approveItemModal').modal('show');
                            }
                        
                            document.getElementById('approveCheck').addEventListener('change', function() {
                                document.getElementById('approveBtn').disabled = !this.checked;
                            });
                        
                            document.getElementById('approveBtn').addEventListener('click', function() {
                                fetch(`/item/${selectedItemId}/approve`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        status: 'Approved'
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        if (data.deleted) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Deleted',
                                                text: 'Item deleted successfully!',
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(() => {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Approved',
                                                text: 'Item approved successfully!',
                                                showConfirmButton: false,
                                                timer: 2000
                                            }).then(() => {
                                                location.reload();
                                            });
                                        }
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'An error occurred while processing the item.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while processing the item.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            });
                        </script>
                        

                        

                        {{-- <script>
                            let currentItemId = null;
                        
                            function showRejectModal(itemId, itemName) {
                                currentItemId = itemId;
                                document.getElementById('rejectItemName').textContent = itemName;
                                $('#rejectItem').modal('show');
                            }
                        
                            function rejectItem() {
                                if (document.getElementById('rejectConfirm').checked) {
                                    // AJAX request to update the item status to Rejected
                                    $.ajax({
                                        url: '/item/' + currentItemId + '/reject',
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(response) {
                                            if(response.success) {
                                                // Update the item row in the table or reload the page
                                                location.reload();
                                            }
                                        },
                                        error: function(xhr) {
                                            console.log(xhr.responseText);
                                        }
                                    });
                                    $('#rejectItem').modal('hide');
                                }
                            }
                        </script> --}}

                        <script>
                            let selectedItemRejectId;
                            
                            function openRejectModal(itemId, itemName) {
                                selectedItemRejectId = itemId;
                                document.getElementById('rejectItemTitle').innerText = itemName;
                                document.getElementById('rejectCheck').checked = false;
                                document.getElementById('rejectBtn').disabled = true;
                                $('#rejectItemModal').modal('show');
                            }
                            
                            document.getElementById('rejectCheck').addEventListener('change', function() {
                                document.getElementById('rejectBtn').disabled = !this.checked;
                            });
                            
                            document.getElementById('rejectBtn').addEventListener('click', function() {
                                fetch(`/item/${selectedItemRejectId}/reject`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        status: 'Rejected'
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Item rejected successfully!',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'An error occurred while rejecting the item.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while rejecting the item.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            });
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

</body>
</html>