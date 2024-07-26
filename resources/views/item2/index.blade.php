<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Datatable Engineer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        /* .custom-checkbox{
            width:10px;
            height: :10px;
        } */

    </style>

</head>
<body style="background: lightgray">

                                    <!-- Form untuk mengirim nilai ke server -->
                                    <form id="values-form" method="GET" action="{{ route('update-values') }}">
                                        @csrf
                                        <input type="hidden" name="a" id="input-a" value="{{ session('a',1) }}">
                                        <input type="hidden" name="b" id="input-b" value="{{ session('b',1) }}">
                                    </form>


                                    <form id="addItemForm">
                                <input type="hidden" id="input-a" name="id_pabrik" value="{{ session('a', 1) }}">
                                <input type="hidden" id="input-b" name="id_bagian" value="{{ session('b', 1) }}">
                                <!-- Form fields for item details -->
                                
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
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 1 ? 'active' : '' }}" onclick="updateValues(1, {{ session('b', 1) }})">- ECR P1B</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 2 ? 'active' : '' }}" onclick="updateValues(2, {{ session('b', 1) }})">- ECR P2B</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 3 ? 'active' : '' }}" onclick="updateValues(3, {{ session('b', 1) }})">- ECR P3</a></li>
                                        <li><a href="#" class="link-tertiery rounded align-items-center text-decoration-none btn btn-toggle {{ session('a', 1) == 4 ? 'active' : '' }}" onclick="updateValues(4, {{ session('b', 1) }})">- ECR P4</a></li>
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
                            <button class="btn btn-outline-primary {{ session('b', 1) == 1 ? 'active' : '' }}" onclick="updateValues({{ session('a', 1) }}, 1)">
                            {{--  {{ $bagian->nama_bagian }} --}} Amonia</button>
                                        
                            <button class="btn btn-outline-primary {{ session('b', 1) == 2 ? 'active' : '' }}" onclick="updateValues({{ session('a', 1) }}, 2)">
                            {{-- {{ $bagian->nama_bagian }} --}} Urea</button>
                                
                            <button class="btn btn-outline-primary {{ session('b', 1) == 3 ? 'active' : '' }}" onclick="updateValues({{ session('a', 1) }}, 3)">
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

                            {{-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="">
                            History Report
                            </button> --}}


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
                        

                            
                                                        

                           {{--  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahItemModal">
                            Tambah Item
                            </button>

                          <!-- Modal -->
                            <div class="modal fade" id="tambahItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form id="addItemForm">
                                            <div class="modal-body">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group">
                                                    <label for="itemName">Item Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="itemName" name="item_name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="itemNo">Item No</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="itemNo" name="item_no" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="itemR">R</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="itemR" name="item_r" required>
                                                    </div>
                                                </div>
                                                <div class="multiple-inputs">
                                                    <div class="form-group">
                                                        <label for="itemS" class="ms-2">S</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemS" name="item_s" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemL" class="ms-2">L</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemL" name="item_l" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemP" class="ms-2">P</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemP" name="item_p" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="multiple-inputs">
                                                    <div class="form-group">
                                                        <label for="itemE" class="ms-2">E</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemE" name="item_e" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemB" class="ms-2">B</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemB" name="item_b" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemH" class="ms-2">H</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemH" name="item_h" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" onclick="submitAddItemForm()">OK</button> 
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                        
                                        

                                    </div>
                                </div>
                            </div> --}}

                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahItemModal">
                                Tambah Item
                            </button>
                        
                            <!-- Modal -->
                            <div class="modal fade" id="tambahItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                        
                                        <form id="addItemForm" action="{{route('item2.store')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="itemName">Item Name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="itemName" name="item_name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="itemNo">Item No</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="itemNo" name="item_no" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="itemR">R</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="itemR" name="item_r" required>
                                                    </div>
                                                </div>
                                                <div class="multiple-inputs">
                                                    <div class="form-group">
                                                        <label for="itemS" class="ms-2">S</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemS" name="item_s" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemL" class="ms-2">L</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemL" name="item_l" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemP" class="ms-2">P</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemP" name="item_p" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="multiple-inputs">
                                                    <div class="form-group">
                                                        <label for="itemE" class="ms-2">E</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemE" name="item_e" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemB" class="ms-2">B</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemB" name="item_b" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="itemH" class="ms-2">H</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="itemH" name="item_h" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">OK</button> 
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>





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
{{--                                         <a href="#" class="btn btn-md btn-primary mb-3" onclick="calculateAndSave({{ $items->id }})">Calculate</a>
 --}}                                        
                                        <!-- Button to Open Edit Modal -->
                                        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#editItemModal" onclick="loadEditItemData({{ $items->id }})">
                                            Edit
                                        </button>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="editItemForm">
                                                        <div class="modal-body">
                                                            <input type="hidden" id="editItemId" name="item_id">
                                                            <div class="form-group">
                                                                <label for="editItemName">Item Name</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="editItemName" name="item_name" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editItemNo">Item No</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="editItemNo" name="item_no" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editItemR">R</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" id="editItemR" name="item_r" required>
                                                                </div>
                                                            </div>
                                                            <div class="multiple-inputs">
                                                                <div class="form-group">
                                                                    <label for="editItemS" class="ms-2">S</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="editItemS" name="item_s" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editItemL" class="ms-2">L</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="editItemL" name="item_l" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editItemP" class="ms-2">P</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="editItemP" name="item_p" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="multiple-inputs">
                                                                <div class="form-group">
                                                                    <label for="editItemE" class="ms-2">E</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="editItemE" name="item_e" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editItemB" class="ms-2">B</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="editItemB" name="item_b" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editItemH" class="ms-2">H</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="editItemH" name="item_h" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary" onclick="submitEditItemForm()">Update</button>
                                                            
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        

                                       {{--  <button type="button" class="btn btn-danger delete-item-btn mb-3" data-toggle="modal" data-target="#deleteModal" data-id="{{ $items->id }}" data-name="{{ $items->item_name }}">
                                            Hapus
                                        </button> --}}

                                        <button type="button" class="btn btn-danger delete-item-btn mb-3" data-toggle="modal" data-target="#deleteModal" data-id="{{ $items->id }}" data-name="{{ $items->item_name }}">
                                            Hapus
                                        </button>
                                        

                                       <!-- Delete Confirmation Modal -->
                                        {{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus <span id="deleteItemName"></span></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="deleteForm" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="item_id" id="deleteItemId">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" width="20px" height="20px" id="confirmDelete" required>
                                                                <label class="form-check-label" for="confirmDelete">
                                                                    Saya yakin ingin menghapus ini
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Equipment <span id="deleteItemName"></span></h5>
                                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="deleteForm" method="POST">
                                                            @csrf
                                                            @method('PATCH') <!-- Gunakan metode PATCH untuk mengubah status -->
                                                            <input type="hidden" name="item_id" id="deleteItemId">
                                                            <div class="form-check row">
                                                                <div class="col-md-1">
                                                                    <input class="form-check-input col-5" type="checkbox" id="confirmDelete" width="20px" height="20px" required>
                                                                </div>
                                                                <div class="col-10 me-2">
                                                                    
                                                                    <label class="form-check-label" for="confirmDelete">
                                                                        Saya yakin ingin menghapus ini
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        


                                        
                                        
                                        <!-- <a href="#" class="btn btn-md btn-success mb-3">Edit/a>
                                        <a href="#" class="btn btn-md btn-danger mb-3">Hapus</a> -->
                                        
                                        {{-- <a href="#" class="btn btn-md btn-warning text-white mb-3">Trend</a> --}}

                                        <button class="btn btn-md btn-warning text-white mb-3 btn-trends" data-id="{{ $items->id }}" data-toggle="modal" data-target="#trendModal">Trends</button>
                                        </td>

                                       
                                         <!-- Modal -->
                                       {{--  <div class="modal" id="trendModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="trendModalLabel">Trend Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="trendsTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Last Update</th>
                                                                    <th>R</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Data akan ditambahkan di sini melalui AJAX -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <!-- Modal -->
                                   {{--  <div class="modal fade" id="trendModal" tabindex="-1" role="dialog" aria-labelledby="trendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="trendModalLabel">Trend Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table" id="trendsTable">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Last Update</th>
                                                                <th>R</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Data akan ditambahkan di sini melalui AJAX -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Modal -->
                                    



                                    </tr>
                                
                                
                                   {{--  <div class="alert alert-danger">
                                        Data Item belum Tersedia.
                                    </div> --}}
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                                        <div class="modal fade" id="trendModal" tabindex="-1" role="dialog" aria-labelledby="trendModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="trendModalLabel">Trend Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table" id="trendsTable">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Last Update</th>
                                                                <th>R</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Data akan ditambahkan di sini melalui AJAX -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        
                        <script>
                            function updateValues(a, b) {
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

                             <!-- SweetAlert -->
                            @if (session('success'))
                        <script>
                            
                                
                                    document.addEventListener('DOMContentLoaded', function () {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: '{{ session('success') }}',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    });
                                    
                                    // Menampilkan SweetAlert jika ada pesan error
                                    @if($errors->any())
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: '{{ $errors->first() }}',
                                            showConfirmButton: true
                                        });
                                    @endif
                            
                        </script>

                
                        @endif
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
                        </script> --}}

                        {{-- <script>
                            function submitAddItemForm() {
                                const form = document.getElementById('addItemForm');
                                const formData = new FormData(form);
                                
                                // Tambahkan nilai a dan b dari session
                                const a = document.getElementById('input-a').value;
                                const b = document.getElementById('input-b').value;
                            
                                fetch(''{{ route('item2.store') }}'', {
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
                            </script> --}}


                            <script>
                                function submitAddItemForm() {
                                    const form = document.getElementById('addItemForm');
                                    const formData = new FormData(form);
                                
                                    fetch('{{ route('item2.store') }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: formData
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
                                                location.reload(); // Refresh the page to show the new item
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
                            
                        


                        {{-- <script>
                            // Fungsi untuk memuat data item ke dalam modal
                            function loadEditItemData(itemId) {
                                // Ambil baris item berdasarkan ID
                                const row = document.querySelector(`tr[data-id="${itemId}"]`);

                                // Ambil data dari baris
                                const itemName = row.querySelector('td:nth-child(5)').innerText;
                                const itemNo = row.querySelector('td:nth-child(4)').innerText;
                                const r = row.querySelector('td:nth-child(13)').innerText;
                                const s = row.querySelector('td:nth-child(6)').innerText;
                                const l = row.querySelector('td:nth-child(7)').innerText;
                                const p = row.querySelector('td:nth-child(8)').innerText;
                                const e = row.querySelector('td:nth-child(9)').innerText;
                                const b = row.querySelector('td:nth-child(10)').innerText;
                                const h = row.querySelector('td:nth-child(11)').innerText;

                                // Isi data ke dalam form modal
                                document.getElementById('editItemId').value = itemId;
                                document.getElementById('editItemName').value = itemName;
                                document.getElementById('editItemNo').value = itemNo;
                                document.getElementById('editItemR').value = r;
                                document.getElementById('editItemS').value = s;
                                document.getElementById('editItemL').value = l;
                                document.getElementById('editItemP').value = p;
                                document.getElementById('editItemE').value = e;
                                document.getElementById('editItemB').value = b;
                                document.getElementById('editItemH').value = h;
                            }

                            // Fungsi untuk mengirim data yang telah diedit
                            function submitEditItemForm() {
                                // Ambil data dari form
                                const itemId = document.getElementById('editItemId').value;
                                const itemName = document.getElementById('editItemName').value;
                                const itemNo = document.getElementById('editItemNo').value;
                                const itemR = document.getElementById('editItemR').value;
                                const itemS = document.getElementById('editItemS').value;
                                const itemL = document.getElementById('editItemL').value;
                                const itemP = document.getElementById('editItemP').value;
                                const itemE = document.getElementById('editItemE').value;
                                const itemB = document.getElementById('editItemB').value;
                                const itemH = document.getElementById('editItemH').value;

                                // Kirim data ke server
                                fetch(`/item2/${itemId}/update`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        item_name: itemName,
                                        item_no: itemNo,
                                        item_r: itemR,
                                        item_s: itemS,
                                        item_l: itemL,
                                        item_p: itemP,
                                        item_e: itemE,
                                        item_b: itemB,
                                        item_h: itemH
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Item updated successfully!',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });

                                    // Tutup modal
                                    $('#editItemModal').modal('hide');

                                    // Perbarui data di tabel jika perlu
                                    // Misalnya, dengan memuat ulang tabel atau memperbarui baris yang relevan
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while updating the item.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            }
                        </script> --}}



                        <script>
                            // Fungsi untuk memuat data item ke dalam modal
                            function loadEditItemData(itemId) {
                                // Ambil baris item berdasarkan ID
                                const row = document.querySelector(`tr[data-id="${itemId}"]`);
                        
                                // Ambil data dari baris
                                const itemName = row.querySelector('td:nth-child(5)').innerText;
                                const itemNo = row.querySelector('td:nth-child(4)').innerText;
                                const r = row.querySelector('td:nth-child(13)').innerText;
                                const s = row.querySelector('td:nth-child(6)').innerText;
                                const l = row.querySelector('td:nth-child(7)').innerText;
                                const p = row.querySelector('td:nth-child(8)').innerText;
                                const e = row.querySelector('td:nth-child(9)').innerText;
                                const b = row.querySelector('td:nth-child(10)').innerText;
                                const h = row.querySelector('td:nth-child(11)').innerText;
                        
                                // Isi data ke dalam form modal
                                document.getElementById('editItemId').value = itemId;
                                document.getElementById('editItemName').value = itemName;
                                document.getElementById('editItemNo').value = itemNo;
                                document.getElementById('editItemR').value = r;
                                document.getElementById('editItemS').value = s;
                                document.getElementById('editItemL').value = l;
                                document.getElementById('editItemP').value = p;
                                document.getElementById('editItemE').value = e;
                                document.getElementById('editItemB').value = b;
                                document.getElementById('editItemH').value = h;
                            }
                        
                            // Fungsi untuk mengirim data yang telah diedit
                            function submitEditItemForm() {
                                // Ambil data dari form
                                const itemId = document.getElementById('editItemId').value;
                                const itemName = document.getElementById('editItemName').value;
                                const itemNo = document.getElementById('editItemNo').value;
                                const itemR = document.getElementById('editItemR').value;
                                const itemS = document.getElementById('editItemS').value;
                                const itemL = document.getElementById('editItemL').value;
                                const itemP = document.getElementById('editItemP').value;
                                const itemE = document.getElementById('editItemE').value;
                                const itemB = document.getElementById('editItemB').value;
                                const itemH = document.getElementById('editItemH').value;
                        
                                // Kirim data ke server
                                fetch(`/item2/${itemId}/update`, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        item_name: itemName,
                                        item_no: itemNo,
                                        item_r: itemR,
                                        item_s: itemS,
                                        item_l: itemL,
                                        item_p: itemP,
                                        item_e: itemE,
                                        item_b: itemB,
                                        item_h: itemH
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Item updated successfully!',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                        
                                        // Tutup modal
                                        $('#editItemModal').modal('hide');
                        
                                        // Perbarui data di tabel jika perlu
                                        // Misalnya, dengan memuat ulang tabel atau memperbarui baris yang relevan
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'An error occurred while updating the item.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while updating the item.',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                });
                            }
                        </script>
                        


                        {{-- <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                            const deleteForm = document.getElementById('deleteForm');
                            const deleteItemName = document.getElementById('deleteItemName');
                            const deleteItemId = document.getElementById('deleteItemId');
                            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

                            document.querySelectorAll('.delete-item-btn').forEach(button => {
                                button.addEventListener('click', function() {
                                    const itemName = this.dataset.name;
                                    const itemId = this.dataset.id;
                                    deleteItemName.textContent = itemName;
                                    deleteItemId.value = itemId;
                                    deleteForm.action = `/item2/${itemId}/delete`; // Sesuaikan dengan rute delete kamu
                                    deleteModal.show();
                                });
                            });

                            confirmDeleteBtn.addEventListener('click', function() {
                                deleteForm.submit();
                            });
                        });
                        </script> --}}

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                                const deleteForm = document.getElementById('deleteForm');
                                const deleteItemName = document.getElementById('deleteItemName');
                                const deleteItemId = document.getElementById('deleteItemId');
                                const confirmDeleteCheckbox = document.getElementById('confirmDelete');
                                const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
                        
                                document.querySelectorAll('.delete-item-btn').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const itemName = this.dataset.name;
                                        const itemId = this.dataset.id;
                                       
                                        deleteItemName.textContent = itemName;
                                        deleteItemId.value = itemId;
                                        deleteForm.action = `/item2/${itemId}/change-status`; // Sesuaikan dengan rute untuk mengubah status
                                        deleteModal.show();
                                    });
                                });
                        
                                confirmDeleteBtn.addEventListener('click', function() {
                                    deleteForm.submit();
                                });

                                // Fungsi untuk mengupdate status tombol
                                function updateButtonStatus() {
                                    confirmDeleteBtn.disabled = !confirmDeleteCheckbox.checked;
                                }

                                // Event listener untuk checkbox
                                confirmDeleteCheckbox.addEventListener('change', updateButtonStatus);

                                // Inisialisasi status tombol saat halaman dimuat
                                updateButtonStatus();
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- <script>
        document.getElementById('confirmDelete').addEventListener('change', function() {
            const deleteButton = document.getElementById('deleteButton');
            deleteButton.disabled = !this.checked;
        });
    </script> --}}

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