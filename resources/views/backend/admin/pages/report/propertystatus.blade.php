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
                        <h1>Property Status Report</h1>
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
                                            <th>Flat no</th>
                                            <th>Status</th>
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
        const get_url = (url, id) => {
            return url.replace('item_id', id);
        }
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
                    url: "{{ route('admin.report.getpropertystatus') }}",
                    data: data,
                    success: function(response) {
                        ele('tbody').innerHTML = '';
                        var len = 0;
                        if (response.room) {
                            len = response['room'].length;
                        }
                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['room'][i].id;
                                var room = response['room'][i].room_no;
                                var status = response['room'][i].status;
                                if (status == 1) {
                                    var status =
                                        `<span class="badge badge-success">Vacnat</span>`;
                                } else {
                                    var status =
                                        `<span class="badge badge-danger">Occupied</span>`;
                                }
                                var html = `<tr>
                                                <td>${id}</td>
                                                <td>${room}</td>
                                                <td>${status}</td>
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
