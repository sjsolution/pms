@extends('backend.admin.layouts.master')
@section('title', 'Receiveable Status Report')
@section('style')
    <style>
        .toast-message {
            color: white;
            font-size: 14px;
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
                        <h1>Receiveable Status of Property</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if (Session::has('msg'))
                                <div class="col-md-12">
                                    <div class="alert alert-success" style="margin-top: 5px">{{ Session::get('msg') }}</div>
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Building (Drop Down)</label><span class="text-danger">*</span>
                                            <select class="form-control select2" name="building_id" id="building_id"
                                                style="width: 100%;">
                                                <option selected="true" disabled="disabled">--Select Building--
                                                </option>
                                                @foreach ($building as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Building</th>
                                            <th>Flat no</th>
                                            <th>Receiveable Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">

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
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            $('#building_id').change(function() {
                // Department id
                var id = $(this).val();

                var data = {
                    "_token": "{{ csrf_token() }}",
                    "building_id": id,
                };

                // AJAX request 
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.report.getreceiveable_status') }}",
                    data: data,
                    success: function(response) {
                        ele('tbody').innerHTML = '';
                        var len = 0;
                        if (response.property) {
                            len = response['property'].length;
                        }
                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['property'][i].id;
                                var building = response['property'][i].building.name;
                                var flatno = response['property'][i].room.room_no;
                                var contractexpire = response['property'][i].contract_expire;
                                var property_rental = response['property'][i].property_rental;
                                var monthly_rent = response['property'][i].monthly_rent;

                                var advance = response['property'][i].advance;
                                var total_amount = response['property'][i].total_amount;
                                var tenant_pay_amount = response['property'][i]
                                    .tenant_pay_amount;
                                var tenant_remaining_amount = response['property'][i]
                                    .tenant_remaining_amount;

                                if (property_rental == 0) {
                                    var currentdate = new Date();
                                    var expiredate = new Date(contractexpire);
                                    var name = response['property'][i].tenant_name;
                                    if (currentdate > expiredate) {
                                        var receiveable = monthly_rent;
                                        var total = +monthly_rent + +response['property'][i]
                                            .monthly_rent;
                                        total += tenant_remaining_amount;
                                        toastr.error(`${name} has remaining amount`);
                                    } else {
                                        if (tenant_remaining_amount != 0) {
                                            var receiveable = tenant_pay_amount -
                                                tenant_remaining_amount;

                                        } else {
                                            var receiveable = '0';
                                        }
                                    }
                                } else {
                                    var name = response['property'][i].name;
                                    if (advance == total_amount) {
                                        var receiveable = '0';
                                    } else {
                                        toastr.error(`${name} has remaining amount`);
                                        var remaining = total_amount - advance;
                                        var receiveable = remaining;
                                    }
                                }
                                var html = `<tr>
                                <td>${id}</td>
                                <td>${building}</td>
                                <td>${flatno}</td>
                                <td>${receiveable}</td>
                                </tr>
                        `;
                                ele('tbody').innerHTML += html;
                            }
                        }
                    }

                });
            });
        })
    </script>
@endsection
