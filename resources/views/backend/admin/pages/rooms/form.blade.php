@extends('backend.admin.layouts.master')
@if (isset($property->id))
    @section('title')
        {{ __('Edit Room') }}
    @endsection
@else
    @section('title')
        {{ __('Add Room') }}
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
                        <h1>Manage Room</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rooms</li>
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
                                @if (isset($property->id))
                                    <h3 class="card-title">Edit Room</h3>
                                @else
                                    <h3 class="card-title">Add Room</h3>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.room.store') }}" method="POST">
                                @if (Session::has('msg'))
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                                    </div>
                                @endif
                                @csrf
                                @if (isset($room->id))
                                    <input type="hidden" id="id" name="id" value="{{ $room->id }}">
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Building (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="property_id"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Building--</option>
                                                    @foreach ($property as $item)
                                                        <option value="{{ $item->id }}" @if (isset($room->id))
                                                            {{ $item->id == $room->property_id ? 'selected' : '' }}
                                                        @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('property_id') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Flat Type (Drop Down)</label><span
                                                    class="text-danger">*</span>
                                                <select class="form-control select2" name="flat_type" style="width: 100%;">
                                                    <option value="" selected disabled>--Select Flat--</option>
                                                    @foreach ($flattype as $item)
                                                        <option value="{{ $item->id }}" @if (isset($room->id))
                                                            {{ $item->id == $room->flat_type ? 'selected' : '' }}
                                                        @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('flat_type') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Room no</label><span class="text-danger">*</span>
                                                <input type="text" name="room_no" class="form-control" id="name"
                                                    placeholder="Enter Building Name"
                                                    value="{{ isset($room->room_no) ? $room->room_no : '' }}">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('room_no') }}</p>
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
