@extends('backend.admin.layouts.master')
@section('title', 'Property Rentals')
@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 90px;
            height: 34px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2ab934;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(55px);
            -ms-transform: translateX(55px);
            transform: translateX(55px);
        }

        /*------ ADDED CSS ---------*/
        .on {
            display: none;
        }

        .on {
            color: white;
            position: absolute;
            transform: translate(-70%, -50%);
            top: 50%;
            left: 50%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        .off {
            color: white;
            position: absolute;
            transform: translate(-30%, -50%);
            top: 50%;
            left: 50%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        input:checked+.slider .on {
            display: block;
        }

        input:checked+.slider .off {
            display: none;
        }

        /*--------- END --------*/

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .toast-message {
            font-size: 14px;
            color: white;
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
                        <h1>Property Rentals</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Property Rental</li>
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
                                    <div class="alert alert-success msg" style="margin-top: 5px">{{ Session::get('msg') }}
                                    </div>
                                </div>
                            @endif

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <a href="{{ route('admin.propertyrental.create') }}" class="btn btn-primary"
                                            style="float: left">ADD+</a>
                                    </div>

                                </div>

                            </div>

                            @foreach ($alerts as $item)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Mr.{{ $item['name'] }}</strong> contract will expire in {{ $item['days'] }}
                                    days.
                                    <a data-toggle="modal" onclick="modalclear({{ json_encode($item, true) }});"
                                        data-target="#paymentModal" class="btn btn-success">Paid</a>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Building Name</th>
                                            <th>Flat Type</th>
                                            <th>Flat no</th>
                                            <th>Name</th>
                                            <th>Rent Date</th>
                                            <th>Contract Start</th>
                                            <th>Contract Expires</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($propertyrental as $row)
                                            <tr>
                                                <input type="hidden" class="delete_val" value="{{ $row->id }}">
                                                <td>{{ $row->building->name }}</td>
                                                <td>{{ $row->flattype->name }}</td>
                                                <td>{{ $row->room->room_no }}</td>
                                                <td>{{ $row->tenant_name }}</td>
                                                <td>{{ $row->rent_due_date }}</td>
                                                <td>{{ $row->contract_start }}</td>
                                                <td>{{ $row->contract_expire }}</td>
                                                @if ($row->status == 1)
                                                    <td><span class="badge badge-success">Ongoing</span></td>
                                                @else
                                                    <td><span class="badge badge-danger">Expired</span></td>
                                                @endif
                                                <td>
                                                    <a class="btn btn-danger" title="Terminate" style="padding: 2px 10px;"
                                                        onclick="terminate({{ $row }});"><i
                                                            class="fa fa-xmark"></i></a>
                                                    <a href="{{ route('admin.propertyrental.edit', $row->id) }}"
                                                        class="btn btn-info" title="Edit" style="padding: 2px 8px;"><i
                                                            class="fa fa-pencil"></i></a>
                                                </td>
                                            </tr>
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
                                <input type="hidden" name="name" value="" id="name">
                                <input type="hidden" name="property_id" value="" id="property_id">
                                <input type="hidden" name="building_id" value="" id="building_id">
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Mode of Payment</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="checkbox" class="checkboxval" value="0" onclick="paymentmode('cash');"
                                    name="mode_payment" id="cash_pay">
                                <label for="">Cash</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="checkbox" class="checkboxval" value="1"
                                    onclick="paymentmode('cheque');" name="mode_payment" id="cheque_pay">
                                <label for="">Cheque</label>
                            </div>
                        </div>
                    </div>
                    <div id="check_detail" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Cheque Details</label>
                                    <input type="text" class="form-control" name="cheque_detail" id="cheque_detail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Deposit Date</label>
                                    <input type="date" class="form-control" name="deposit_date" id="deposit_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Clearance Date</label>
                                    <input type="date" class="form-control" name="clearance_date"
                                        id="clearance_date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="storecontract();">Save</button>
                    </div>
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
                "autoWidth": false,
                "responsive": true,
            });
        });
        const get_url = (url, id) => {
            return url.replace('item_id', id);
        }
        window.setTimeout(function() {
            $(".msg").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);

        const terminate = (item) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data = {
                "_token": "{{ csrf_token() }}",
                "id": item.id,
                "room_id": item.room_id,
            };
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.propertyrental.terminate') }}",
                data: data,
                success: function(response) {
                    if (response) {
                        toastr.success(response.mesg);
                        window.setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        }

        const paymentmode = (checkbox) => {
            var cash = ele('cash_pay');
            var cheque = ele('cheque_pay');
            var cheque_detail = ele('check_detail');
            if (checkbox == 'cash') {
                cash.checked = true;
                cheque.checked = false;
                cheque_detail.style.display = "none";
            } else {
                cash.checked = false;
                cheque.checked = true;
                cheque_detail.style.display = "block";
            }
        }

        const modalclear = (item) => {
            ele('cash_pay').checked = false;
            ele('cheque_pay').checked = false;
            ele('building_id').value = '';
            ele('property_id').value = '';
            ele('name').value = '';
            ele('cheque_detail').value = '';
            ele('date').value = '';
            ele('deposit_date').value = '';
            ele('clearance_date').value = '';

            var property = item.property;
            ele('name').value = property.tenant_name;
            ele('property_id').value = property.id;
            ele('building_id').value = property.building_id;
        }

        const storecontract = () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var checkedValue = $('.checkboxval:checked').val();

            var data = {
                "_token": "{{ csrf_token() }}",
                "name": ele('name').value,
                "building_id": ele('building_id').value,
                "property_id": ele('property_id').value,
                "cheque_detail": ele('cheque_detail').value,
                "date": ele('date').value,
                "deposit_date": ele('deposit_date').value,
                "clearance_date": ele('clearance_date').value,
                "payment_mode": checkedValue,
            };
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.propertyrental.storecontract') }}",
                data: data,
                success: function(response) {
                    if(response){
                        $('#paymentModal').modal('hide');
                        toastr.success(response.mesg);
                        window.setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });

        }
    </script>
@endsection
