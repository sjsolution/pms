@extends('backend.admin.layouts.master')
@if (isset($flattype->id))
    @section('title')
        {{ __('Edit Flat Type') }}
    @endsection
@else
    @section('title')
        {{ __('Add Flat Type') }}
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
                        <h1>Flat Type</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Flat Type</li>
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
                                @if (isset($flattype->id))
                                    <h3 class="card-title">Edit FlatType Form</h3>
                                @else
                                    <h3 class="card-title">FlatType Form</h3>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.flattype.store') }}" method="POST">
                                @if (Session::has('msg'))
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                                    </div>
                                @endif
                                @csrf
                                @if (isset($flattype->id))
                                    <input type="hidden" id="id" name="id" value="{{ $flattype->id }}">
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Flat Name</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter Flat Name"
                                                    value="{{ isset($flattype->name) ? $flattype->name : '' }}">
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
