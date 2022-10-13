@extends('backend.admin.layouts.master')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('public/hms/dashboard/style.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="form-group">
                            <label for="">Select Building (Drop Down)</label><span class="text-danger">*</span>
                            <select name="building_id" id="building_id" class="form-control select2">
                                <option value="" selected disabled>--Select Building--</option>
                                @foreach ($building as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="box-content" id="box">

                        </div>
                    </div>
                </div>
                <br>
                <div class="row" id="cards">

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
                    url: "{{ route('admin.dashboard.getroom') }}",
                    data: data,
                    success: function(response) {
                        console.log(response);
                        ele('box').innerHTML = '';
                        ele('cards').innerHTML = '';
                        var len = 0;
                        if (response.room) {
                            len = response['room'].length;
                        }
                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['room'][i].id;
                                var room_no = response['room'][i].room_no;
                                var flattype = response['room'][i].flattype.name;
                                var status = response['room'][i].status;
                                if (status == 1) {

                                    var color = "rgb(126, 205, 90)";
                                } else {
                                    var color = "red";
                                }
                                var html = `<div class="style-box" style="background-color:${color}">
                                    <p class="">${flattype}<br>${room_no}</p>
                                </div>`;

                                ele('box').innerHTML += html;
                            }

                            var html = `<div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box" style="background-color: #7ECD5A;">
                            <div class="inner">
                                <h3>${response.vacantcount}</h3>

                                <p>Vacant</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bed"></i>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-6" >
                        <!-- small box -->
                        <div class="small-box" style="background-color: red;">
                            <div class="inner">
                                <h3>${response.occupiedcount}</h3>

                                <p>Occupied</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bed"></i>
                            </div>
                            
                        </div>
                    </div>`
                            ele('cards').innerHTML = html;
                        }
                    }

                });
            });
        })
    </script>
@endsection
