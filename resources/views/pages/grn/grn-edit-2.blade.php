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
            <h1>Grn Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Home</a></li>
                    <li class="breadcrumb-item active">Grn create</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        @if (session('message'))
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Wow...",
                    text: "Successfully Completed!",
                })
            </script>
        @endif

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

                            <form action="{{ route('grn-store') }}" method="post" class="needs-validation" novalidate>
                                @csrf
                                <!-- Purchase Order Master Fields -->
                                <div class="card p-3"
                                    style="border: 1px solid black; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <h4>Purchase Order Master</h4>
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group row mt-3">
                                                <label class="col-sm-5 col-form-label text-start">Asset
                                                    Item Po Msts
                                                    ID</label>
                                                <div class="col-sm-7">

                                                    <input type="number" class="form-control"
                                                        value="{{ $asset_item_po->id }}" name="assetitem_po_mst_id"
                                                        readonly>
                                                </div>
                                            </div>

                                            {{-- <div class="form-group row mt-3">
                                                <label class="col-sm-5 col-form-label text-start">Spareparts
                                                    ID</label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control"
                                                        name="spareparts_po_mst_id"
                                                        value="{{ $asset_item_po->spareParts->id }}" readonly>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="form-group row mt-3">
                                                <label class="col-sm-5 col-form-label text-start">Company
                                                    ID</label>
                                                <div class="col-sm-7">
                                                    <input type="number" class="form-control" name="company_id"
                                                        value="{{ $asset_item_po->company_id }}" readonly>
                                                </div>
                                            </div> --}}
                                            <input type="hidden" class="form-control" name="uom_id"
                                                value="{{ $asset_item_po_dtls[0]->uom_id }}">

                                        </div>

                                        <div class="col-md-6">
                                            {{-- <div class="form-group row mt-3">
                                                <label for="approver" class="col-sm-3 col-form-label text-end">Approver
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="approver"
                                                        id="approver" placeholder="Approver" required>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="form-group row mt-3">
                                                <label for="workshop_id"
                                                    class="col-sm-3 col-form-label text-end">Workshop Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="workshop_id" id="workshop_id"
                                                        required>
                                                        <option selected disabled value="">Work Shop Name</option>
                                                        @foreach ($workShopName as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="form-group row mt-3">
                                                <label for="supplier_id"
                                                    class="col-sm-3 col-form-label text-end">Supplier Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="supplier_id" id="supplier_id"
                                                        required>
                                                        <option selected disabled value="">Suppiler Name</option>
                                                        @foreach ($suppilerName as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>

                                <!-- Asset Item PO Details Fields -->
                                <div class="card p-1 mt-2"
                                    style="border: 1px solid black; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <h4>Asset Item PO Details</h4>
                                    <div class="table-responsive1">
                                        {{-- 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row mt-3">

                                                    @foreach ($asset_item_po_dtls as $details)
                                                        <label for="po_gen_id_1"
                                                            class="col-sm-5 col-form-label text-start">Category Model
                                                            Name
                                                        </label>

                                                        <div class="col-sm-7">

                                                            <input value="{{ $details->categorymodel_id }}"
                                                                type="hidden" name="categorymodel_id[]">

                                                            <input type="text" class="form-control"
                                                                value="{{ $details->categoryModel->name }}" readonly>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row mt-3">
                                                </div>
                                            </div>
                                        </div> 
                                        --}}


                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Category Model Name</th>
                                                    <th>Brand Name</th>

                                                    <th>Unit Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total Amount</th>
                                                    <th>Currency</th>
                                                    <th>Company Id</th>
                                                    <th>Supplier Id</th>
                                                    <th>Asset Status</th>



                                                </tr>
                                            </thead>
                                            <tbody id="detailRows">
                                                @foreach ($asset_item_po_dtls as $details)
                                                    <tr>

                                                        <input type="hidden" value="{{ $details->id }}"
                                                            class="form-control1" name="asset_item_po_dtls_id[]"
                                                            id="quantity_1" readonly>

                                                        <td>

                                                            <input type="hidden" name="categorymodel_id[]"
                                                                value="{{ $details->categorymodel_id }}">

                                                            <input type="text"
                                                                value="{{ $details->categoryModel->name }}"
                                                                class="form-control" readonly>

                                                        </td>

                                                        <td>
                                                            <input type="hidden" name="brand_id[]"
                                                                value="{{ $details->brand_id }}">

                                                            <input type="text" value="{{ $details->brand->name }}"
                                                                class="form-control" readonly>
                                                        </td>

                                                        <td>

                                                            <input type="number" value="{{ $details->unit_price }}"
                                                                class="form-control" name="unit_price[]" readonly>
                                                        </td>

                                                        <td><input value="{{ $details->quantity }}" type="number"
                                                                class="form-control" name="quantity[]" id="quantity_1"
                                                                readonly></td>

                                                        <td><input value="{{ $details->total_amount }}" type="number"
                                                                class="form-control" name="total_amount[]"
                                                                id="total_amount_1" readonly>
                                                        </td>

                                                        <td>
                                                            <input type="hidden"
                                                                value="{{ $details->assetItemPo->currency }}"
                                                                name="currency[]">
                                                            <input
                                                                value="{{ $details->assetItemPo->currency == 1 ? 'BDT' : 'Rs' }}"
                                                                type="text" class="form-control" readonly>
                                                        </td>

                                                        <td>
                                                            <input value="{{ $details->assetItemPo->company_id }}"
                                                                type="hidden" name="company_id[]">
                                                            <input value="{{ $details->assetItemPo->company->name }}"
                                                                type="text" class="form-control" readonly>
                                                        </td>

                                                        <td>
                                                            <input value="{{ $details->assetItemPo->supplier_id }}"
                                                                type="hidden" name="supplier_id[]">
                                                            <input value="{{ $details->assetItemPo->supplier->name }}"
                                                                type="text" class="form-control" readonly>
                                                        </td>

                                                        <td>

                                                            <input value="{{ $details->assetItemPo->status }}"
                                                                type="text" class="form-control"
                                                                name="asset_status[]" readonly>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>


                                    </div>

                                </div>

                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6 text-center">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- List Section --}}
        {{-- 
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card c-shadow">
                        <div class="card-body">
                            <h5 class="card-title">Asset Purchase Order List</h5>

                            <!-- Table with stripped rows -->
                            <table id="datatable" class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr class="text-center bg-dark text-light">

                                        
                                        <th scope="col">Serial No</th>
                                        <th scope="col">Po Gen ID</th>
                                        <th scope="col">Approver Name</th>
                                        <th scope="col">WorkShop Name</th>
                                        <th scope="col">Suppiler Name</th>
                                        <th scope="col">Total Item</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Creator</th>

                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseOrders as $purchaseOrder)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $purchaseOrder->po_gen_id }}</td>
                                            <td>{{ $purchaseOrder->approver }}</td>
                                            <td>{{ $purchaseOrder->workshop->name }}</td>
                                            <td>{{ $purchaseOrder->supplier->name }}</td>
                                            <td>{{ $purchaseOrder->details->count() }}</td>
                                            <td>{{ $purchaseOrder->details->sum('total_amount') }}</td>
                                            <td>{{ ucfirst($purchaseOrder->status) }}</td>
                                            <td>{{ $purchaseOrder->user->name }}</td>
                                            <td class="text-center">
                                                @if (in_array($purchaseOrder->status, ['pending', 'inactive']))
                                                    <a href="{{ route('assetPurchaseOrder-edit', $purchaseOrder->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endif
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
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const poGenIdInput = document.getElementById('po_gen_id');
            const generatePoGenId = () => {
                const date = new Date();
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const uniqueNumber = Math.floor(1000 + Math.random() * 9000);
                return `PO${year}${month}${day}${uniqueNumber}`;
            };
            poGenIdInput.value = generatePoGenId();

            function calculateTotalAmount(unitPrice, quantity) {
                return unitPrice * quantity;
            }

            // Add row functionality
            document.getElementById('addRow').addEventListener('click', () => {
                const detailRows = document.getElementById('detailRows');
                const newRow = detailRows.children[0].cloneNode(true);
                newRow.querySelectorAll('input, select').forEach(input => input.value = '');
                detailRows.appendChild(newRow);

                updateGrandTotal();
            });

            // Remove row functionality
            document.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeRow')) {
                    event.target.closest('tr').remove();
                    updateGrandTotal();
                }
            });

            // Remove row functionality
            document.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeRow')) {
                    event.target.closest('tr').remove();
                    updateGrandTotal();
                }
            });

            // Update the grand total
            function updateGrandTotal() {
                const rows = document.querySelectorAll('#detailRows tr');
                let grandTotal = 0;

                rows.forEach(row => {
                    const unitPrice = parseFloat(row.querySelector('[name="unit_price[]"]').value);
                    const quantity = parseFloat(row.querySelector('[name="quantity[]"]').value);
                    if (!isNaN(unitPrice) && !isNaN(quantity)) {
                        const totalAmount = calculateTotalAmount(unitPrice, quantity);
                        row.querySelector('[name="total_amount[]"]').value = totalAmount;
                        grandTotal += totalAmount;
                    }
                });

                document.getElementById('grandTotal').value = grandTotal.toFixed(2);
            }

            // Update total on input change
            document.addEventListener('input', (event) => {
                if (event.target.matches('[name="unit_price[]"], [name="quantity[]"]')) {
                    updateGrandTotal();
                }
            });

            // Initial update
            updateGrandTotal();
        });
    </script>

</body>
