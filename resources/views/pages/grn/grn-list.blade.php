<!-- ======= Head ======= -->
@include('admin.inc.head')
<!-- ======= Head ======= -->

<body>

    <!-- ======= Header ======= -->
    @include('admin.inc.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.inc.sidebar')
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>GRN Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">GRN List</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card c-shadow">
                        <div class="card-body">
                            <h5 class="card-title">GRN List</h5>

                            <!-- Table with stripped rows -->
                            <table id="datatable" class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr class="text-center bg-dark text-light">

                                        {{-- 
                                        <th scope="col">Sl#</th>
                                        <th scope="col">id</th> 
                                        --}}
                                        <th scope="col">Assetitem Po</th>
                                        <th scope="col">Spareparts Po</th>
                                        <th scope="col">Category Model</th>
                                        <th scope="col">Spart Parts</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Amount</th>
                                        {{-- <th scope="col">Uom Id</th> --}}
                                        <th scope="col">Stock Status</th>
                                        {{-- <th scope="col">Item Type</th> --}}

                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grn as $result)
                                        <tr>
                                            {{-- 
                                            <th class="text-center" scope="row">{{  $loop->iteration }}</th>
                                            <td>{{  $result->id }}</td>  
                                            --}}
                                            <td>{{ $result->assetitem_po_mst->po_gen_id }}</td>
                                            <td>{{ $result->spareparts_po_mst->po_gen_id }}</td>
                                            <td>{{ $result->categorymodel->name }}</td>
                                            <td>{{ $result->spartpart->name }}</td>
                                            <td>{{ $result->brand->name }}</td>
                                            <td>{{ $result->unit_price }}</td>
                                            <td>{{ $result->quantity }}</td>
                                            <td>{{ $result->totla_amount }}</td>
                                            {{-- <td>{{ $result->uom_id }}</td> --}}
                                            <td>{{ $result->stock_status }}</td>
                                            {{-- <td>{{ $result->item_type }}</td> --}}
                                            <td class="text-center">
                                                <a href="{{ route('grn-edit', $result->id) }}"><span
                                                        class="badge rounded-pill text-bg-warning">Edit</span></a>

                                                <a onclick="return confirm('Are you sure to delete ?')"
                                                    href="{{ url('grn-delete/' . $result->id) }}"
                                                    class="badge rounded-pill text-bg-danger">Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                            <div class="pages">
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <!-- bootstrap5 dataTables js cdn -->
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });
        </script>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('admin.inc.footer')
    <!-- End Footer -->

</body>
<!-- Template Main JS File -->
<script src="{{ asset('admin/assets/js/main.js') }}"></script>

</html>
