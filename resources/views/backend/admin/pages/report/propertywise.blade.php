@extends('backend.admin.layouts.master')
@section('title', 'Period Wise Report')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Property Wise Report</h1>
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
                                            <th>Flat Type</th>
                                            <th>Flat no</th>
                                            <th>Tenant Name</th>
                                            <th>Contract Expiry</th>
                                            <th>Rent Amount</th>
                                            <th>Rent type</th>
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
                    url: "{{ route('admin.report.getpropertywise') }}",
                    data: data,
                    success: function(response) {
                        console.log(response);
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
                                var flattype = response['property'][i].flattype.name;
                                var flatno = response['property'][i].room.room_no;
                                var tenantname = response['property'][i].tenant_name;
                                var contractexpire = response['property'][i].contract_expire;
                                var rentamount = response['property'][i].monthly_rent;
                                var renttype = response['property'][i].rent_type;
                                var html = `<tr>
                                    <td>${id}</td>
                                    <td>${building}</td>
                                    <td>${flattype}</td>
                                    <td>${flatno}</td>
                                    <td>${tenantname}</td>
                                    <td>${contractexpire}</td>
                                    <td>${rentamount}</td>
                                    <td>${renttype}</td>
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
