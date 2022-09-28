@extends('backend.admin.layouts.master')
@section('title')
    {{ __('Add user') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage User</h1>
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
                                <h3 class="card-title">Add Room</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.user.store') }}" method="POST">
                                @if (Session::has('msg'))
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                                    </div>
                                @endif
                                @csrf
                                @if (isset($user->id))
                                 <input type="hidden" name="id" value="{{isset($user->id) ? $user->id: ''}}">
                                @endif

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label><span class="text-danger">*</span>
                                                <input type="text" class="form-control" value="{{isset($user->name) ? $user->name: ''}}" name="name" id=""
                                                    placeholder="Enter Name">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label><span class="text-danger">*</span>
                                                <input type="text" class="form-control" value="{{isset($user->email)? $user->email: ''}}" name="email" id=""
                                                    placeholder="example@example.com">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Password</label><span class="text-danger">*</span>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="************" value="">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Select Building (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="property_id"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Building--</option>
                                                    @foreach ($building as $item)
                                                        <option value="{{ $item->id }}" @if (isset($user->id))
                                                            {{ $item->id == $user->property_id ? 'selected' : '' }}
                                                        @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('property_id') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Assin Role (DropDown)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="role"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Role--</option>
                                                    @foreach ($role as $item)
                                                        <option value="{{ $item->id }}" @if (isset($user->id))
                                                            {{ $item->id == $user->role ? 'selected' : '' }}
                                                        @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('role') }}</p>
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
@endsection
