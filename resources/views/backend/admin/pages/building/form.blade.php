@extends('backend.admin.layouts.master')
@if (isset($building->id))
    @section('title')
        {{ __('Edit Building') }}
    @endsection
@else
    @section('title')
        {{ __('Add Building') }}
    @endsection
@endif
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Building</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Building</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                @if (isset($building->id))
                                    <h3 class="card-title">Edit Building Form</h3>
                                @else
                                    <h3 class="card-title">Building Form</h3>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.building.store') }}" method="POST">
                                @if (Session::has('msg'))
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                                    </div>
                                @endif
                                @csrf
                                @if (isset($building->id))
                                    <input type="hidden" id="id" name="id" value="{{ $building->id }}">
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Building Name</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter Flat Name"
                                                    value="{{ isset($building->name) ? $building->name : '' }}">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>


                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content -->
@endsection
