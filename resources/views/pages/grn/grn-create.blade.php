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
                    <li class="breadcrumb-item active">GRN create</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        @if (session('message'))
            <script>
                Swal.fire({
                    icon: "Success",
                    title: "Wow...",
                    text: "Succssfully Completed!",
                })
            </script>
        @endif

        {{--         
        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card c-shadow">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action='{{ route('grn-store') }}' method="post" class="row g-3 needs-validation"
                                novalidate>
                                @csrf

                                <div class="row mt-5">

                                    <div class="col-3 text-end">
                                        <label for="name" class="form-label formsrow">Assetitem Po Msts<span
                                                style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="assetitem_po_id" required>
                                            <option selected disabled value="">Choose Asset</option>
                                            @foreach ($asset_item_po_mst as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->po_gen_id }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label for="name" class="form-label formsrow">Spareparts Po <span
                                                style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="spareparts_po_id" required>
                                            <option selected disabled value="">Choose Spareparts</option>
                                            @foreach ($spareparts_po_mst as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->po_gen_id }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Category Model<span
                                                style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="category_model_id" required>
                                            <option selected disabled value="">Choose Category Model</option>
                                            @foreach ($category_model as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Spart Parts<span
                                                style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="spare_parts_id" required>
                                            <option selected disabled value="">Choose Spart Parts</option>
                                            @foreach ($spartpart as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Brand<span style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="brand_id" required>
                                            <option selected disabled value="">Choose Brands</option>
                                            @foreach ($brand as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label for="meter_no" class="form-label formsrow">Unit Price<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-5 text-end">
                                        <input type="number" placeholder="Unit Price" class="form-control formsrow"
                                            name ="unit_price" required>
                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3  text-end">
                                        <label class="form-label formsrow">Quantity<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="number" placeholder="Quantity" class="form-control formsrow"
                                            name ="quantity" required>
                                    </div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Total Amount<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="number" placeholder="Total Amount" class="form-control formsrow"
                                            name ="total_amount" required>
                                    </div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Uom Id<span
                                                style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="uom_id" id="module" required>
                                            <option selected disabled value="">Choose Uom</option>
                                            @foreach ($umos as $umo)
                                                <option value="{{ $umo->id }}">{{ $umo->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <input type="hidden" class="form-control my-border formsrow"
                                        value="{{ $company[0]->id }}" name ="company_id" id="company_id">

                                    <div class="col-4"></div>

                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6"><button class="btn btn-primary "
                                                type="submit">Save</button></div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
         --}}

        {{--          
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card c-shadow">
                        <div class="card-body">
                            <h5 class="card-title">Grn List</h5>

                            <!-- Table with stripped rows -->
                            <table id="datatable" class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr class="text-center bg-dark text-light">

                                        <th scope="col">Assetitem Po</th>
                                        <th scope="col">Spareparts Po</th>
                                        <th scope="col">Category Model</th>
                                        <th scope="col">Spart Parts</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Uom Id</th>
                                        <th scope="col">Stock Status</th>

                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($grn as $result)
                                        <tr>

                                            <td>{{ $result->assetitem_po_mst->po_gen_id }}</td>
                                            <td>{{ $result->spareparts_po_mst->po_gen_id }}</td>
                                            <td>{{ $result->categorymodel->name }}</td>
                                            <td>{{ $result->spartpart->name }}</td>
                                            <td>{{ $result->brand->name }}</td>
                                            <td>{{ $result->unit_price }}</td>
                                            <td>{{ $result->quantity }}</td>
                                            <td>{{ $result->totla_amount }}</td>
                                            <td>{{ $result->uom_id }}</td>
                                            <td>{{ $result->stock_status }}</td>
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
        --}}

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card c-shadow">
                        <div class="card-body">
                            <h5 class="card-title">Grn List</h5>

                            <!-- Table with stripped rows -->
                            <table id="datatable" class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr class="text-center bg-dark text-light">

                                        <th scope="col">Po Gen id</th>
                                        <th scope="col">Approver</th>
                                        <th scope="col">Status</th>

                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($pendingAssetItemPoMsts as $result)
                                        <tr>

                                            <td>{{ $result->po_gen_id }}</td>
                                            <td>{{ $result->approver }}</td>
                                            <td>{{ $result->status }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('grn-edit', $result->id) }}"><span
                                                        class="badge rounded-pill text-bg-warning">Create</span></a>

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
