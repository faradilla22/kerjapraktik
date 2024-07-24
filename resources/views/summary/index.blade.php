@extends('layouts.apps')

@section('content')
<title>@section('title','Summary ECR')</title>
                                    
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 row">
                
                <div>
                    <h3 class="text-center my-4"></h3>
                    <hr>
                </div>
                <div class="col-md-10 card border-0 shadow-sm rounded">
                    
                                    <!-- Form untuk mengirim nilai ke server -->
                                     <form id="values-form" method="GET" action="{{ route('update-values2') }}">
                                        @csrf
                                        <input type="hidden" name="c" id="input-c" value="{{ session('c',1) }}">
                                        <input type="hidden" name="d" id="input-d" value="{{ session('d',1) }}">
                                    </form>

                                <div class="row">
                                <div class="dropdown mt-2">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                        {{ (session('c', 1) == 1 ? 'Pusri 1B' : (session('c', 1) == 2 ? 'Pusri 2B' : (session('c', 1) == 3 ? 'Pusri 3' : (session('c',1) == 4 ? 'Pusri 4' : 'Select Item')))) }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item {{ session('c', 1) == 1 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('d', 1) }}, 1)">Pusri 1B</a></li>
                                        <li><a class="dropdown-item {{ session('c', 1) == 2 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('d', 1) }}, 2)">Pusri 2B</a></li>
                                        <li><a class="dropdown-item {{ session('c', 1) == 3 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('d', 1) }}, 3)">Pusri 3</a></li>
                                        <li><a class="dropdown-item {{ session('c', 1) == 4 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('d', 1) }}, 4)">Pusri 4</a></li>

                                    </ul>
                                </div>
                                                      
                                <div class="dropdown mb-5">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="true">
                                        {{ (session('d', 1) == 1 ? 'Amonia' : (session('d', 1) == 2 ? 'Urea' : (session('d', 1) == 3 ? 'Utility' : 'Select Item'))) }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item {{ session('d', 1) == 1 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('c', 1) }}, 1)">Amonia</a></li>
                                        <li><a class="dropdown-item {{ session('d', 1) == 2 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('c', 1) }}, 2)">Urea</a></li>
                                        <li><a class="dropdown-item {{ session('d', 1) == 3 ? 'active' : '' }}" href="#" onclick="updateValues2({{ session('c', 1) }}, 3)">Utility</a></li>
                                    </ul>
                                </div>
                            </div>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                       <!-- Dua canvas untuk dua chart -->
                       <div class="row">
                        <div class="chart-container">
                            <canvas id="ecrPieChart"></canvas>
                        </div>
                        <div class="chart-container">
                            <canvas id="rrPieChart"></canvas>
                        </div>
                    </div>
                      
                        <table class="table table-bordered table-sm w-70 mt-2" id="myTable">
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



                                </tr>
                            </thead>
                            <tbody id="itemTableBody">
                                @foreach ($item as $items) 
                                @if (/* $items->id_pabrik==$a && $items->id_bagian==$b */ $items->id_pabrik == session('c', 1) && $items->id_bagian == session('d', 1)) 
            
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
                                        
                                                         
                                    </tr>
                                
                                
                                   
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                        
                        <script>
                            
                        
                            function updateValues(a, b) {
                                document.getElementById('input-a').value = a;
                                document.getElementById('input-b').value = b;
                                document.getElementById('values-form2').submit();
                            }
                        </script>
                        
                        <script>
                                    function updateValues2(c, d) {
                                        document.getElementById('input-c').value = c;
                                        document.getElementById('input-d').value = d;
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

                        <script>
                            function submitAddItemForm() {
                                const form = document.getElementById('addItemForm');
                                const formData = new FormData(form);
                                
                                // Tambahkan nilai a dan b dari session
                                const a = document.getElementById('input-a').value;
                                const b = document.getElementById('input-b').value;

                                fetch('/items/store', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify(Object.assign(Object.fromEntries(formData), { a: a, b: b }))
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Item added and calculated successfully!',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            $('#tambahItemModal').modal('hide');
                                            // Optionally refresh table or perform other UI updates
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'An error occurred while adding the item.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while adding the item.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            }
                        </script>


                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var ecrValues = [];
                                var rrValues = [];
                                var labels = [];
                                
                                document.querySelectorAll('#itemTableBody tr').forEach(function (row) {
                                    var ecrValue = row.querySelector('.ecr-value').textContent;
                                    var rrValue = row.querySelector('.rr-value').textContent;
                                    var itemName = row.querySelector('td:nth-child(5)').textContent; // Column for item name
                                    ecrValues.push(ecrValue);
                                    rrValues.push(rrValue);
                                    labels.push(itemName);
                                });

                                var ctxEcr = document.getElementById('ecrPieChart').getContext('2d');
                                var ctxRr = document.getElementById('rrPieChart').getContext('2d');

                                var ecrPieChart = new Chart(ctxEcr, {
                                    type: 'pie',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'ECR',
                                            data: ecrValues,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (tooltipItem) {
                                                        return labels[tooltipItem.dataIndex] + ': ' + ecrValues[tooltipItem.dataIndex];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });

                                var rrPieChart = new Chart(ctxRr, {
                                    type: 'pie',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'RR',
                                            data: rrValues,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function (tooltipItem) {
                                                        return labels[tooltipItem.dataIndex] + ': ' + rrValues[tooltipItem.dataIndex];
                                                    }
                                                }
                                            }
                                        }
                                    }
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

@endsection