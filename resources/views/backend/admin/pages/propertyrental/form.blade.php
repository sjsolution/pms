@extends('backend.admin.layouts.master')
@section('title')
    {{ __('Add Property Rental') }}
@endsection
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Property Rental</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Property Rental</li>
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
                                    <h3 class="card-title">Edit Property Rental Form</h3>
                                @else
                                    <h3 class="card-title">Add Property Rental Form</h3>
                                @endif

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.propertyrental.store') }}" method="POST">
                                @if (Session::has('msg'))
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ Session::get('msg') }}</div>
                                    </div>
                                @endif
                                @csrf
                                <input type="hidden" name="property_rental" value="0">
                                @if (isset($propertyrental->id))
                                    <input type="hidden" id="id" name="id" value="{{ $propertyrental->id }}">
                                @endif
                                @if (Auth::user())
                                    @php
                                        $user_id = user()->id;
                                    @endphp
                                    <input type="hidden" name="user_id" value="{{ isset($user_id) ? $user_id : '' }}">
                                @endif
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Building (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="building_id"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Building--</option>
                                                    @foreach ($building as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (isset($propertyrental->id)) {{ $item->id == $propertyrental->building_id ? 'selected' : '' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('building_id') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select FlatType (Drop Down)</label>
                                                <select class="form-control select2" name="flat_type" id="flat_type"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Flat--</option>
                                                    @foreach ($flattype as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (isset($propertyrental->id)) {{ $item->id == $propertyrental->flat_type ? 'selected' : '' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('flat_type') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Flat (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="room_id" id="room_id"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Room--</option>

                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('room_id') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">

                                            <label>Tenant Details:</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_name">Name</label><span class="text-danger">*</span>
                                                <input type="text" name="tenant_name"
                                                    value="{{ isset($propertyrental->tenant_name) ? $propertyrental->tenant_name : '' }}"
                                                    class="form-control" id="tenant_name" placeholder="Name">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_contact_no">Contact no</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" name="tenant_contact_no"
                                                    value="{{ isset($propertyrental->tenant_contact_no) ? $propertyrental->tenant_contact_no : '' }}"
                                                    class="form-control" id="tenant_contact_no" placeholder="Contact no">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_contact_no') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_document_type">Document Type</label><span
                                                    class="text-danger">*</span>
                                                <select name="tenant_document_type" id="" class="form-control">
                                                    <option value="" selected disabled>--Select Document Type--
                                                    </option>
                                                    <option value="passport"
                                                        @if (isset($propertyrental->id)) {{ $propertyrental->tenant_document_type == 'passport' ? 'selected' : '' }} @endif>
                                                        Passport</option>
                                                    <option value="id"
                                                        @if (isset($propertyrental->id)) {{ $propertyrental->tenant_document_type == 'id' ? 'selected' : '' }} @endif>
                                                        ID</option>
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_document_type') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_document_no">Document no</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" name="tenant_document_no"
                                                    value="{{ isset($propertyrental->tenant_document_no) ? $propertyrental->tenant_document_no : '' }}"
                                                    class="form-control" id="tenant_document_no"
                                                    placeholder="Document no">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_document_no') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_company_name">Company Name</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" name="tenant_company_name"
                                                    value="{{ isset($propertyrental->tenant_company_name) ? $propertyrental->tenant_company_name : '' }}"
                                                    class="form-control" id="tenant_company_name"
                                                    placeholder="Company name">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_company_name') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="monthly_rent">Rent Type</label><span
                                                    class="text-danger">*</span>
                                                <select name="rent_type" id="" class="form-control select2">
                                                    <option value="" selected disabled>--Select RentType--</option>
                                                    <option value="monthly"
                                                        @if (isset($propertyrental->id)) {{ $propertyrental->rent_type == 'monthly' ? 'selected' : '' }} @endif>
                                                        Monthly</option>
                                                    <option value="quarterly"
                                                        @if (isset($propertyrental->id)) {{ $propertyrental->rent_type == 'quarterly' ? 'selected' : '' }} @endif>
                                                        Quarterly</option>
                                                    <option value="biyearly"
                                                        @if (isset($propertyrental->id)) {{ $propertyrental->rent_type == 'biyearly' ? 'selected' : '' }} @endif>
                                                        Biyearly</option>
                                                    <option value="yearly"
                                                        @if (isset($propertyrental->id)) {{ $propertyrental->rent_type == 'yearly' ? 'selected' : '' }} @endif>
                                                        Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="monthly_rent">Rent</label><span class="text-danger">*</span>
                                                <input type="text" name="monthly_rent"
                                                    value="{{ isset($propertyrental->monthly_rent) ? $propertyrental->monthly_rent : '' }}"
                                                    class="form-control" id="monthly_rent" placeholder="Rent">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('monthly_rent') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_pay_amount">Rent Paying Amount</label><span class="text-danger">*</span>
                                                <input type="text" required name="tenant_pay_amount"
                                                    value="{{ isset($propertyrental->tenant_pay_amount) ? $propertyrental->tenant_pay_amount : '' }}"
                                                    class="form-control" id="tenant_pay_amount" placeholder="Rent">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_pay_amount') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tenant_remaining_amount">Rent Remaining Amount</label>
                                                <input type="text" name="tenant_remaining_amount"
                                                    value="{{ isset($propertyrental->tenant_remaining_amount) ? $propertyrental->tenant_remaining_amount : '' }}"
                                                    class="form-control" id="tenant_remaining_amount" placeholder="Rent">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('tenant_remaining_amount') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rent_due_date">Rent Due Date</label><span
                                                    class="text-danger">*</span>
                                                <input type="date" name="rent_due_date"
                                                    value="{{ isset($propertyrental->rent_due_date) ? $propertyrental->rent_due_date : '' }}"
                                                    class="form-control" id="rent_due_date" placeholder="Due Date">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('rent_due_date') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_start">Contract Start</label><span
                                                    class="text-danger">*</span>
                                                <input type="date" name="contract_start"
                                                    value="{{ isset($propertyrental->contract_start) ? $propertyrental->contract_start : '' }}"
                                                    class="form-control" id="contract_start"
                                                    placeholder="Contract Start">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('contract_start') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_expire">Contract Expire</label><span
                                                    class="text-danger">*</span>
                                                <input type="date" name="contract_expire"
                                                    value="{{ isset($propertyrental->contract_expire) ? $propertyrental->contract_expire : '' }}"
                                                    class="form-control" id="contract_expire"
                                                    placeholder="Contract Expire">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('contract_expire') }}</p>
                                                @endif
                                            </div>
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

@section('scripts')
    <script>
        const get_url = (url, id) => {
            return url.replace('item_id', id);
        }
        $(document).ready(function() {

            $('#flat_type').change(function() {
                // Department id
                var id = $(this).val();

                // Empty the dropdown
                $('#room_id').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: get_url(
                        "{{ route('admin.propertyrental.getroom', 'item_id') }}",
                        id),
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response.room) {
                            len = response['room'].length;
                        }

                        if (len > 0) {
                            // Read data and create <option >
                            for (var i = 0; i < len; i++) {
                                var id = response['room'][i].id;
                                var room = response['room'][i].room_no;
                                var option = `<option value="${id}">${room}</option>`;
                                ele('room_id').innerHTML += option;
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
