@extends('layouts.apps')

@section('content')
<title>@section('title','Datatable Engineer')</title>
<script>
        $(document).ready(function() {
        // Handler untuk tombol Trends
        $('#itemTableBody').on('click', '.btn-trends', function() {
            const id_barang = $(this).data('id');
            loadTrends(id_barang);
        });
    });

    function loadTrends(id_barang) {
        $.ajax({
            url: `/item2/${id_barang}/trends`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if(response.trends) {
                    const trends = response.trends;
                    let trendsHtml = '';
                    if (trends.length > 0) {
                        $.each(trends, function(index, trend) {
                            trendsHtml += `<tr>
                                <td>${index + 1}</td>
                                <td>${trend.timestamp}</td>
                                <td>${trend.R}</td>
                            </tr>`;
                        });
                    } else {
                        trendsHtml = '<tr><td colspan="3">No trends available</td></tr>';
                    }
                    $('#trendsTable tbody').html(trendsHtml);
                    $('#trendModal').modal('show');
                } else {
                    alert('No data found');
                }
            },
            error: function(error) {
                console.log(error);
                alert('Error fetching data');
            }
        });
    }
</script>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 row">
                
                <div>
                    <h3 class="text-center my-4">JUDUL</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    
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

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#historyReportModal">
                            History Report
                        </button>
                        
                        <!-- The Modal -->
                        <div class="modal fade" id="historyReportModal" tabindex="-1" role="dialog" aria-labelledby="historyReportModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="historyReportModalLabel">History Report Ammonia P2B</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal Terbit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>24-07-09</td>
                                                    <td><a href="#">Download</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>23-07-19</td>
                                                    <td><a href="#">Download</a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>22-07-10</td>
                                                    <td><a href="#">Download</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-custom" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahItemModal">
                        Terbitkan Report
                        </button>
                        
                        <!-- The Modal -->
                        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">Terbitkan report</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group row">
                                                <label for="createdBy" class="col-sm-4 col-form-label mb-3">Dibuat Oleh</label>
                                                <div class="col-sm-8">
                                                    <input type="text" readonly class="form-control-plaintext" id="createdBy" value="Ikhsan">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="approvedBy" class="col-sm-4 col-form-label mb-3">Disetujui Oleh</label>
                                                <div class="col-sm-8">
                                                    <input type="text" readonly class="form-control-plaintext" id="approvedBy" value="Adibrata">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success btn-custom" data-dismiss="modal">OK</button>
                                        <button type="button" class="btn btn-secondary btn-custom" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                            <div class="form-check row">
                                                                <div class="col-md-1">
                                                                <input type="checkbox" class="form-check-input col-5" id="approveCheck">
                                                                </div>

                                                                <div class="col-10 me-2">
                                                                <label class="form-check-label" for="approveCheck">Saya yakin ingin menyetujui ini</label>
                                                                </div>
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
                                                                <div class="col-md-1">
                                                                <input type="checkbox" class="form-check-input col-5" id="rejectCheck">
                                                                </div>
                                                                <div class="col-10 me-2">
                                                                <label class="form-check-label" for="rejectCheck">Saya yakin ingin menolak ini</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" id="rejectBtn" disabled>OK</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-md btn-warning text-white mb-3 btn-trends" data-id="{{ $items->id }}" data-toggle="modal" data-target="#trendModal">Trends</button>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                        </tbody>
                    </table>

                        <script>
                            function updateValues3(a, b) {
                                document.getElementById('input-a').value = a;
                                document.getElementById('input-b').value = b;
                                document.getElementById('values-form').submit();
                            }
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