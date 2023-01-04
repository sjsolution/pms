@extends('backend.admin.layouts.master')
@if (isset($property->id))
    @section('title')
        {{ __('Edit Property Registeration') }}
    @endsection
@else
    @section('title')
        {{ __('Property Registeration') }}
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
                        <h1>Property Registeration</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Property Registeration</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <button type="button" id="add_building" onclick="buildmodal()" style="text-align: right"
                            class="btn btn-success" data-toggle="modal" data-target="#buildingmodal">
                            Add Building+
                        </button>
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
                                    <h3 class="card-title">Edit Registration Form</h3>
                                @else
                                    <h3 class="card-title">Registration Form</h3>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.property.store') }}" method="POST">
                                @if (Session::has('msg'))
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                                    </div>
                                @endif
                                @csrf
                                @if (isset($property->id))
                                    <input type="hidden" id="id" name="id" value="{{ $property->id }}">
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="dropdownbuilding" id="dropdownbuilding">
                                                    <label>Select Building (Drop Down)</label><span
                                                        class="text-danger">*</span>
                                                    <select class="form-control select2" name="select_build_id"
                                                        style="width: 100%;">
                                                        <option value="" selected disabled>--Select Building--
                                                        </option>
                                                        @foreach ($building as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (isset($property->id)) {{ $item->id == $property->building_id ? 'selected' : '' }} @endif>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="" id="inputboxbuild" style="display: none;">
                                                    <label>Building Name</label><span class="text-danger">*</span>
                                                    <input type="hidden" id="building_id" name="building_id_append"
                                                        value="">
                                                    <input type="text" readonly name="building" value=""
                                                        class="form-control" id="building_name_append">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="flats">No. of Flats / Shops</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" name="no_of_flats"
                                                    value="{{ isset($property->no_of_flats) ? $property->no_of_flats : '' }}"
                                                    class="form-control" id="flats" placeholder="No. of Flats / Shops"
                                                    onkeyup="showflatboxes()">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('no_of_flats') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row" id="flatboxesprint">
                                        
                                    </div>

                                    <div>
                                        @if (isset($property->id))
                                            <div class="row">
                                                @foreach ($room as $item)
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">flat no</label>
                                                            <input class="form-control" type="text" name="flat_no[]"
                                                                value="{{ isset($item->room_no) ? $item->room_no : '' }}" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        
                                        @endif

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
    <!-- Modal -->
    <div class="modal fade" id="buildingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Building</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="building_name">Building Name</label><span class="text-danger">*</span>
                                <input type="text" name="name" value="" class="form-control"
                                    id="building_name" placeholder="Enter Building Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="storebuildingmodal();" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        const buildmodal = () => {

            $(document).ready(function() {
                $('#building_name').val('');
            });
        }

        const storebuildingmodal = () => {
            var buildingname = ele('building_name').value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = {
                "_token": $('input[name="csrf-token"]').val(),
                "name": buildingname,
            };

            $.ajax({
                type: "POST",
                url: "{{ route('admin.property.building.store') }}",
                data: data,
                success: function(response) {
                    if (response.building) {
                        $('#buildingmodal').modal('hide');
                        $('#building_name').val('');
                        ele('inputboxbuild').style.display = 'block';
                        ele('dropdownbuilding').style.display = 'none';
                        var name = response.building.name;
                        var id = response.building.id;
                        ele('building_name_append').value = name;
                        ele('building_id').value = id;
                    }
                }

            });
        }

        const showflatboxes = () => {
            let flats = ele('flats').value;
            ele('flatboxesprint').innerHTML = "";
        var fieldhtml = `<div class="col-md-6">
                                <div class="form-group">
                                    <label>Flat Type (Drop Down)</label>
                                    <select class="form-control select2" name="flat_type[]" style="width: 100%;">
                                        <option value="" selected disabled>--Select Flat--</option>
                                        @foreach ($flattype as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->any())
                                        <p class="text-danger">{{ $errors->first('flat_type') }}</p>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>flat no</label>
                                <input class="form-control" type="text" name="flat_no[]" value=""/>
                                </div>
                            </div>   
            `;
            for (let flat = 1; flat <= flats; flat++) {
                ele('flatboxesprint').innerHTML += fieldhtml;
            }
        }
    </script>
@endsection
