@extends('backend.admin.layouts.master')
@section('title')
    {{ __('Edit Rental Daily') }}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .toast-message {
            color: white;
            font-size: 14px;
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
                        <h1>Property Rental Daily</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Property Rental Daily</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.propertyrental.update',$propertyrental->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="property_rental" value="1">
                    @if (Auth::user())
                        @php
                            $user_id = user()->id;
                        @endphp
                        <input type="hidden" name="user_id" value="{{ isset($user_id) ? $user_id : '' }}">
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Room Detail</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                @if (Auth::user()->hasRole('admin'))
                                                    <label>Select Building (Drop Down)</label><span
                                                        class="text-danger">*</span>
                                                    <select class="form-control select2" disabled name="building_id"
                                                        style="width: 100%;">
                                                        <option selected="true" disabled="disabled">--Select Building--
                                                        </option>
                                                        @foreach ($building as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (isset($propertyrental->id)) {{ $item->id == $propertyrental->building_id ? 'selected' : '' }} @endif>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <label for="">Building Name</label><span
                                                        class="text-danger">*</span>
                                                    <input type="hidden" name="building_id"
                                                        value="{{ isset($building->id) ? $building->id : '' }}"
                                                        id="">
                                                    <input type="text" readonly class="form-control"
                                                        value="{{ isset($building->name) ? $building->name : '' }}">
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select FlatType (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" disabled name="flat_type"
                                                    id="flat_type" style="width: 100%;">
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
                                                <label>Select Room (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" disabled name="room_id" id="room_id"
                                                    style="width: 100%;">
                                                    <option value="" selected disabled>--Select Room--</option>
                                                    @foreach ($room as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (isset($propertyrental->id)) {{ $item->id == $propertyrental->room_id ? 'selected' : '' }} @endif>
                                                            {{ $item->room_no }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('room_id') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_days">Total Days</label><span class="text-danger">*</span>
                                                <input type="text" readonly name="total_days"
                                                    value="{{ isset($propertyrental->total_days) ? $propertyrental->total_days : '' }}"
                                                    class="form-control" id="total_days" placeholder="Total Days">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('total_days') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Start Date</label><span class="text-danger">*</span>
                                                <input type="text" id="start_date" readonly name="start_date"
                                                    class="form-control"
                                                    value="{{ isset($propertyrental->start_date) ? $propertyrental->start_date : '' }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">End Date</label><span class="text-danger">*</span>
                                            <input type="text" id="end_date" name="end_date"
                                                value="{{ isset($propertyrental->end_date) ? $propertyrental->end_date : '' }}"
                                                class="form-control" value="" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_amount">Total Amount</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" readonly required name="total_amount"
                                                    value="{{ isset($propertyrental->total_amount) ? $propertyrental->total_amount : '' }}"
                                                    class="form-control" id="total_amount" placeholder="Total Amount">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('total_amount') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="advance">Advance Payment</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" required name="advance"
                                                    value="{{ isset($propertyrental->advance) ? $propertyrental->advance : '' }}"
                                                    class="form-control"  id="advance"
                                                    placeholder="Advance Payment">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('advance') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="room_rate">Room Rate</label><span class="text-danger">*</span>
                                                <input type="text" required name="room_rate"
                                                    value="{{ isset($propertyrental->room_rate) ? $propertyrental->room_rate : '' }}"
                                                    class="form-control" readonly id="room_rate"
                                                    placeholder="Advance Payment">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('room_rate') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    {{-- Guest Detial card --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary" id="guest_detail">
                                <div class="card-header">
                                    <h3 class="card-title">Guest Detail</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Guest Full Name</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" readonly required name="name"
                                                    value="{{ isset($propertyrental->name) ? $propertyrental->name : '' }}"
                                                    class="form-control" id="name" placeholder="Guest Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">No. Of PAX</label><span class="text-danger">*</span>
                                                <input type="text" required readonly name="pax"
                                                    value="{{ isset($propertyrental->pax) ? $propertyrental->pax : '' }}"
                                                    class="form-control" id="pax" placeholder="No. Of PAX">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Vehicle</label><span class="text-danger">*</span>
                                                <input type="text" required name="vehicle" readonly
                                                    value="{{ isset($propertyrental->vehicle) ? $propertyrental->vehicle : '' }}"
                                                    class="form-control" id="vehicle" placeholder="Vehicle">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Mobile No</label><span class="text-danger">*</span>
                                                <input type="text" required name="mobile_no" readonly
                                                    value="{{ isset($propertyrental->mobile_no) ? $propertyrental->mobile_no : '' }}"
                                                    class="form-control" id="mobile_no" placeholder="Mobile No">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Document No</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" required name="document_no" readonly
                                                    value="{{ isset($propertyrental->document_no) ? $propertyrental->document_no : '' }}"
                                                    class="form-control" id="document_no" placeholder="Document No">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Date Of Expiry</label><span
                                                    class="text-danger">*</span>
                                                <input type="date" required name="expiry_date" readonly
                                                    value="{{ isset($propertyrental->expiry_date) ? $propertyrental->expiry_date : '' }}"
                                                    class="form-control" id="expiry_date" placeholder="Date Of Expiry">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nationality</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" required name="nationality" readonly
                                                    value="{{ isset($propertyrental->nationality) ? $propertyrental->nationality : '' }}"
                                                    class="form-control" id="nationality" placeholder="Nationality">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Company Name</label><span
                                                    class="text-danger">*</span>
                                                <input type="text" required name="company_name" readonly
                                                    value="{{ isset($propertyrental->company_name) ? $propertyrental->company_name : '' }}"
                                                    class="form-control" id="company_name" placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Date Of Birth</label>
                                                <input type="date" name="dob" readonly
                                                    value="{{ isset($propertyrental->dob) ? $propertyrental->dob : '' }}"
                                                    class="form-control" id="dob" placeholder="Date Of Birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Document Type</label><span
                                                    class="text-danger">*</span>
                                                <select name="document_type" disabled required
                                                    class="form-control select2" id="">
                                                    <option value="" selected disabled>--Select Document Type--
                                                    </option>
                                                    <option value="passport"
                                                        {{ $propertyrental->document_type == 'passport' ? 'selected' : '' }}>
                                                        Passport</option>
                                                    <option value="id"
                                                        {{ $propertyrental->document_type == 'id' ? 'selected' : '' }}>
                                                        ID</option>
                                                    <option value="d/l"
                                                        {{ $propertyrental->document_type == 'd/l' ? 'selected' : '' }}>
                                                        D/L</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Payment Type</label>
                                                <select name="payment_type" disabled class="form-control select2"
                                                    id="">
                                                    <option value="" selected disabled>--Select Payment Type--
                                                    </option>
                                                    <option value="cash"
                                                        {{ $propertyrental->payment_type == 'cash' ? 'selected' : '' }}>
                                                        Cash</option>
                                                    <option value="credit"
                                                        {{ $propertyrental->payment_type == 'credit' ? 'selected' : '' }}>
                                                        Credit</option>
                                                    <option value="card"
                                                        {{ $propertyrental->payment_type == 'card' ? 'selected' : '' }}>
                                                        Card</option>
                                                    <option value="ledger"
                                                        {{ $propertyrental->payment_type == 'ledger' ? 'selected' : '' }}>
                                                        City Ledger</option>
                                                    <option value="other"
                                                        {{ $propertyrental->payment_type == 'other' ? 'selected' : '' }}>
                                                        Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Board Type</label>
                                                <select name="board_type" disabled class="form-control select2"
                                                    id="">
                                                    <option value="" selected disabled>--Select Board Type--</option>
                                                    <option value="half"
                                                        {{ $propertyrental->board_type == 'half' ? 'selected' : '' }}>Half
                                                    </option>
                                                    <option value="full"
                                                        {{ $propertyrental->board_type == 'full' ? 'selected' : '' }}>Full
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Place Of Birth</label>
                                                <input type="text" name="place_birth" readonly
                                                    value="{{ isset($propertyrental->place_birth) ? $propertyrental->place_birth : '' }}"
                                                    class="form-control" id="place_birth" placeholder="Place Of Birth">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">First Child DOB</label>
                                                <input type="date" name="first_child_dob" readonly
                                                    value="{{ isset($propertyrental->first_child_dob) ? $propertyrental->first_child_dob : '' }}"
                                                    class="form-control" id="first_child_dob"
                                                    placeholder="First Child DOB">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Second Child DOB</label>
                                                <input type="date" name="sec_chhild_dob" readonly
                                                    value="{{ isset($propertyrental->sec_chhild_dob) ? $propertyrental->sec_chhild_dob : '' }}"
                                                    class="form-control" id="sec_chhild_dob"
                                                    placeholder="Second Child DOB">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Infants</label>
                                                <input type="text" name="infants" readonly
                                                    value="{{ isset($propertyrental->infants) ? $propertyrental->infants : '' }}"
                                                    class="form-control" id="infants" placeholder="Infants">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email ID</label>
                                                <input type="email" name="email" readonly
                                                    value="{{ isset($propertyrental->email) ? $propertyrental->email : '' }}"
                                                    class="form-control" id="email" placeholder="Email ID">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Place Of Issue</label>
                                                <input type="text" name="place_issue" readonly
                                                    value="{{ isset($propertyrental->place_issue) ? $propertyrental->place_issue : '' }}"
                                                    class="form-control" id="place_issue" placeholder="Place OF Issue">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address" placeholder="Address" readonly
                                                    value="{{ isset($propertyrental->address) ? $propertyrental->address : '' }}"
                                                    class="form-control">
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
                            </div>
                        </div>
                    </div>
                    {{-- end guest detail --}}
                </form>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var end_date = ele('end_date').value;
            var d = new Date(end_date);
            d.setDate(d.getDate() + 1);
            d = new Date(d);
            $('#end_date').daterangepicker({
                autoUpdateInput: false,
                minDate: d,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            $('#end_date').on('apply.daterangepicker', function(ev, picker) {

                var start_date = picker.startDate.format('MM/DD/YYYY');


                var enddate = picker.endDate.format('MM/DD/YYYY');
                 
                ele('end_date').value = enddate;

                //calculate days
                var date1 = new Date(start_date);

                var date2 = new Date(enddate);

                var Difference_In_Time = date2.getTime() - date1.getTime();

                // To calculate the no. of days between two dates
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                
                var pre_days = ele('total_days').value;
                
                var total = +pre_days + +Difference_In_Days;
                ele('total_days').value = total;

                //price calculation

                var room_rate = ele('room_rate').value;

                var new_amount = room_rate * Difference_In_Days;

                var pre_amount = ele('total_amount').value;

                var total_amount = +pre_amount + +new_amount;

                ele('total_amount').value = total_amount;


            });

        });
    </script>
@endsection
