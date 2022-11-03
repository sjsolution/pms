@extends('backend.admin.layouts.master')
@section('title', 'Property Rentals Daily')
@section('style')
    <style>
        .toast-message {
            font-size: 14px;
            color: white;
        }

        .edit {
            padding: 5px 8px;
            position: absolute;
            right: 12px;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Property Rentals Daily</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Properties</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (Session::has('msg'))
                                <div class="col-md-12">
                                    <div class="alert alert-success" style="margin-top: 5px">{{ Session::get('msg') }}</div>
                                </div>
                            @endif

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <a href="{{ route('admin.propertyrentaldaily.create') }}" class="btn btn-primary"
                                            style="float: left">ADD+</a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Flat No</th>
                                            <th>Flat Type</th>
                                            <th>Guest Name</th>
                                            <th>Paid Amount</th>
                                            <th>Total Amount</th>
                                            <th>Room Status</th>
                                            <th>Booking Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($propertyrentaldaily as $item)
                                            <tr>
                                                <input type="hidden" class="delete_val" value="{{ $item->id }}">
                                                <td>{{ $item->room->room_no }}</td>
                                                <td>{{ $item->flattype->name }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->paymenttrack->sum('amount') }}</td>
                                                <td>{{ $item->total_amount }}</td>
                                                <td>{{ $item->start_date }}-{{ $item->end_date }}</td>
                                                <td>

                                                    @if ($item->status == 1)
                                                        <span class="badge badge-success">Checked-In</span>
                                                    @elseif($item->status == 2)
                                                        <span class="badge badge-danger">Checked Out</span>
                                                    @else
                                                        <span class="badge badge-info">Not Checked-In</span>
                                                    @endif
                                                </td>
                                                <td><a href="{{ route('admin.propertyrental.show', $item->id) }}"
                                                        class="btn  btn-info " title="Show"><i class="fas fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    <a class="btn btn-success " onclick="checkout({{ $item }});"
                                                        title="Checkout"><i class="fa fa-rotate-right"></i></a>
                                                    <a class="btn btn-dark " onclick="frames['frame'].print()"
                                                        title="Print">
                                                        <i class="fa fa-print"></i></a>
                                                    <a href="{{ route('admin.propertyrental.edit', $item->id) }}"
                                                        class="btn btn-secondary" title="Extand">
                                                        <i class="fa fa-pencil"></i></a>
                                                    @if (Auth::user()->hasRole('admin'))
                                                        <a href="#" class="btn btn-danger dltbtn"><i
                                                                class="fas fa-trash" title="Delete"></i></a>
                                                    @endif
                                                    <a data-toggle="modal" onclick="savedata({{ $item }});"
                                                        data-target="#paymentModal" class="btn btn-primary"
                                                        title="Add Payment"><i class="fa fa-circle-plus"></i></a>
                                                </td>
                                            </tr>
                                            <iframe src="{{ route('admin.propertyrental.pdf', $item->id) }}"
                                                style="display:none;" name="frame"></iframe>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- checkout Modal -->
    <div class="modal fade" id="checkoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Please Confirm Balance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="modalbody">
                    <input type="hidden" name="building_id" value="" id="building_id">
                    <input type="hidden" name="propertyrental_id" id="propertyrental_id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Total Amount</label>
                                <input readonly class="form-control" type="text" name="total_amount" value=""
                                    id="total_amount">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Paid Amount</label>
                                <input readonly class="form-control" type="text" name="advance" value=""
                                    id="advance">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Remaining Balance</label>
                                <input readonly class="form-control" type="text" name="remaining" value=""
                                    id="remaining">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Enter Remaining Balance</label>
                                <input class="form-control" type="text" name="remain_receive" value=""
                                    id="remain_receive">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Additional Charges</label>
                                <input class="form-control" type="text" name="additional_charges" value="0"
                                    id="additional_charges">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Select Payment Type</label>
                                <select name="payment_type" id="payment_type" class="form-control select2">
                                    <option value="" selected disabled>--Select Payment--</option>
                                    <option value="cash">Cash</option>
                                    <option value="credit">Credit</option>
                                    <option value="card">Card</option>
                                    <option value="ledger">City Ledger</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p id="message" class="text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="storecheckout()" disabled class="btn btn-primary checkout"><i
                            class="fa fa-rotate-right"></i> Check
                        Out</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Payment Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="property_id" id="property_id" value="">
                                <label for="">Payment Date</label><span class="text-danger">*</span>
                                <input type="date" required class="form-control" name="date" value=""
                                    id="pay_date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Enter Amount</label><span class="text-danger">*</span>
                                <input type="text" required class="form-control" name="amont" value=""
                                    id="pay_amount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="savepayment();" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": true,
            });
        });
        const get_url = (url, id) => {
            return url.replace('item_id', id);
        }
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
        const checkout = (item) => {
            ele('remain_receive').value = '';
            ele('total_amount').value = '';
            ele('advance').value = '';
            ele('remaining').value = '';
            ele('message').innerText = '';
            ele('propertyrental_id').value = '';
            ele('building_id').value = '';
            $('#checkoutmodal').modal('show');
            ele('total_amount').value = item.total_amount;
            ele('advance').value = item.advance;
            ele('propertyrental_id').value = item.id;
            ele('building_id').value = item.building_id;
            var remaining = ele('remaining').value = item.total_amount - item.advance;
            if (remaining != 0) {

            }
        }

        const storecheckout = () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // AJAX request 
            var data = {
                "_token": "{{ csrf_token() }}",
                "building_id": ele('building_id').value,
                "propertyrental_id": ele('propertyrental_id').value,
                "total_amount": ele('total_amount').value,
                "advance": ele('advance').value,
                "remaining": ele('remaining').value,
                "additional_charges": ele('additional_charges').value,
                "payment_type": ele('payment_type').value,
                "remain_receive": ele('remain_receive').value,

            };
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.propertyrental.checkout') }}",
                data: data,
                success: function(response) {
                    if (response) {
                        $('#checkoutmodal').modal('hide');
                        toastr.success('checkout Successfully');
                        window.setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        }

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dltbtn').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest("tr").find('.delete_val').val();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            var data = {
                                "_token": "{{ csrf_token() }}",
                                "id": delete_id,
                            };

                            $.ajax({
                                type: "DELETE",
                                url: get_url(
                                    "{{ route('admin.propertyrental.destroy', 'item_id') }}",
                                    delete_id),
                                data: data,
                                success: function(response) {
                                    if (response.status) {
                                        swal(response.status, {
                                                icon: "success",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            });
                                    } else {
                                        swal(response.error, {
                                                icon: "error",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            });
                                    }
                                }

                            });


                        }
                    });


            });
        });


        const amount = ele('remain_receive');
        const existdelay = 2000;
        let existtimer;
        amount.addEventListener('input', code => {
            clearTimeout(existtimer);
            existtimer = setTimeout(x => {
                $.ajax({
                    data: {
                        amount: amount.value,
                        id: ele('propertyrental_id').value,
                    },
                    type: "POST",
                    url: "{{ route('admin.propertyrental.checkremaining') }}",

                    success: function(response) {
                        let property = response.property;
                        if (property) {
                            var total_amount = ele('total_amount').value;
                            var advanve = ele('advance').value;
                            var remaining = total_amount - advanve;
                            if (amount.value == remaining) {
                                $('.checkout').prop("disabled", false);
                            } else {
                                toastr.error(
                                    `Mr ${property.name} paying amount is not equal to remaining amount.`
                                )
                            }
                        }

                    }

                });
            }, existdelay, code)
        })

        const savedata = (item) => {
            ele('property_id').value
            ele('pay_date').value = '';
            ele('pay_amount').value = '';
            ele('property_id').value = item.id;
        }
        const savepayment = () => {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // AJAX request 
            var data = {
                "_token": "{{ csrf_token() }}",
                "property_id": ele('property_id').value,
                "date": ele('pay_date').value,
                "amount": ele('pay_amount').value,
            };
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.propertyrental.addpayment') }}",
                data: data,
                success: function(response) {

                    if (response.error) {
                        toastr.error(response.error);
                    } else {
                        $('#paymentModal').modal('hide');
                        toastr.success(response.success);
                        window.setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        }
    </script>
@endsection
