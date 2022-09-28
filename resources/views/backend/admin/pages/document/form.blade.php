@extends('backend.admin.layouts.master')
@if (isset($document->id))
    @section('title')
        {{ __('Edit Docuemnt') }}
    @endsection
@else
    @section('title')
        {{ __('Add Docuemnt') }}
    @endsection
@endif
@section('style')
    <style>
        .form-input {
            width: 250px;
            padding: 20px;
            background: #fff;

        }

        .form-input input {
            display: none;
        }

        .form-input label {
            display: block;
            width: 70%;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background: #333;
            color: #fff;
            font-size: 14px;
            font-family: "Open Sans", sans-serif;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            margin-left: 8px;
            margin-top: 9px;
        }

        .form-input img {
            width: 225px;
            height: 195px;
        }

        #file-ip-1 {
            background-image: url({{ url('public/hms/document-default.png') }}), 0, 0;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (isset($document->id))
                            <h1>Edit Docuemnt</h1>
                        @else
                            <h1>Add Docuemnt</h1>
                        @endif

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Document</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (Auth::user())
                        @php
                            $user_id = user()->id;
                        @endphp
                        <input type="hidden" name="user_id" value="{{ isset($user_id) ? $user_id : '' }}">
                    @endif
                    @if (isset($document->id))
                        <input type="hidden" name="id" value="{{ isset($document->id) ? $document->id : '' }}">
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    @if (isset($document->id))
                                        <h3 class="card-title">Edit Document</h3>
                                    @else
                                        <h3 class="card-title">Add Document</h3>
                                    @endif

                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <div class="preview">
                                                        @if (isset($document->image))
                                                            <img width="50%" id="file-ip-1-preview"
                                                                src="{{ URL::asset('public/documents/' . $document->image) }}">
                                                        @else
                                                            <img id="file-ip-1-preview"
                                                                src="{{ URL::asset('public/hms/document-default.png') }}">
                                                        @endif


                                                    </div>
                                                    <label for="file-ip-1">Scanned Docuemnt</label>
                                                    <input type="file" id="file-ip-1" accept="image/*" name="image"
                                                        onchange="showPreview(event);">

                                                    @if ($errors->any())
                                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Docuemnt Title</label>
                                                <input type="text"
                                                    value="{{ isset($document->title) ? $document->title : '' }}"
                                                    class="form-control" name="title" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <input type="text"
                                                    value="{{ isset($document->description) ? $document->description : '' }}"
                                                    class="form-control" name="description" id="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Days Alert</label>
                                                <input type="text"
                                                    value="{{ isset($document->days_alert) ? $document->days_alert : '' }}"
                                                    class="form-control" name="days_alert" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Expiry Date</label>
                                                <input type="date"
                                                    value="{{ isset($document->expiry_date) ? $document->expiry_date : '' }}"
                                                    class="form-control" name="expiry_date">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button tupe="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
