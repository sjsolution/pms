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
                    <div class="col-lg-12 col-md-12 col-12">

                        <div class="box-content">
                            @foreach ($room as $item)
                                @php
                                    if ($item->status == 1) {
                                        $color = "rgb(126, 205, 90)";
                                    } else {
                                        $color = 'red';
                                    }
                                @endphp
                                <div class="style-box" style="background-color:{{ $color }}">
                                    <p class="">{{ $item->flattype->name }}<br> {{ $item->room_no }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
