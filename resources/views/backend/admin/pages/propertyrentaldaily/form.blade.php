@extends('backend.admin.layouts.master')
@section('title')
    {{ __('Property Rental Daily') }}
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
                <form action="{{ route('admin.propertyrentaldaily.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add Room Detail</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Building (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="building_id"
                                                    style="width: 100%;">
                                                    <option selected="true" disabled="disabled">--Select Building--</option>
                                                    @foreach ($building as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (isset($propertyrental->id)) {{ $item->id == $propertyrental->building_id ? 'selected' : '' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select FlatType (Drop Down)</label><span class="text-danger">*</span>
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
                                                <label>Select Room (Drop Down)</label><span class="text-danger">*</span>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_days">Total Days</label><span class="text-danger">*</span>
                                                <input type="text" name="total_days" value="" class="form-control"
                                                    id="total_days" placeholder="Total Days">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('total_days') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Start Date</label><span class="text-danger">*</span>
                                                <input type="text" id="start_date" name="start_date" class="form-control"
                                                    value="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">End Date</label><span class="text-danger">*</span>
                                            <input type="text" id="end_date" name="end_date" class="form-control"
                                                value="" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_amount">Total Amount</label><span class="text-danger">*</span>
                                                <input type="text" required name="total_amount" value=""
                                                    class="form-control" id="total_amount" placeholder="Total Amount">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('total_amount') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="advance">Advance Payment</label><span class="text-danger">*</span>
                                                <input type="text" required name="advance" value=""
                                                    class="form-control" id="advance" placeholder="Advance Payment">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('advance') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="room_rate">Room Rate</label><span class="text-danger">*</span>
                                                <input type="text" required name="room_rate" value=""
                                                    class="form-control" id="room_rate" onkeyup="mutliplyamount()"
                                                    placeholder="Advance Payment">
                                                @if ($errors->any())
                                                    <p class="text-danger">{{ $errors->first('room_rate') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mt-4">

                                                <button type="button" onclick="guestdetail()" style="margin-top: 7px;"
                                                    class="btn btn-success form-control">Room Details Done</button>
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
                            <div class="card card-primary" id="guest_detail" style="display: none;">
                                <div class="card-header">
                                    <h3 class="card-title">Guest Detail</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Guest Full Name</label><span class="text-danger">*</span>
                                                <input type="text" required name="name" value=""
                                                    class="form-control" id="name" placeholder="Guest Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">No. Of PAX</label><span class="text-danger">*</span>
                                                <input type="text" required name="pax" value=""
                                                    class="form-control" id="pax" placeholder="No. Of PAX">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Vehicle</label><span class="text-danger">*</span>
                                                <input type="text" required name="vehicle" value=""
                                                    class="form-control" id="vehicle" placeholder="Vehicle">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Mobile No</label><span class="text-danger">*</span>
                                                <input type="text" required name="mobile_no" value=""
                                                    class="form-control" id="mobile_no" placeholder="Mobile No">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Document No</label><span class="text-danger">*</span>
                                                <input type="text" required name="document_no" value=""
                                                    class="form-control" id="document_no" placeholder="Document No">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Date Of Expiry</label><span class="text-danger">*</span>
                                                <input type="date" required name="expiry_date" value=""
                                                    class="form-control" id="expiry_date" placeholder="Date Of Expiry">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Nationality</label><span class="text-danger">*</span>
                                                <input type="text" required name="nationality" value=""
                                                    class="form-control" id="nationality" placeholder="Nationality">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Company Name</label><span class="text-danger">*</span>
                                                <input type="text" required name="company_name" value=""
                                                    class="form-control" id="company_name" placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Date Of Birth</label>
                                                <input type="date" required name="dob" value=""
                                                    class="form-control" id="dob" placeholder="Date Of Birth">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Document Type</label><span class="text-danger">*</span>
                                                <select name="document_type" class="form-control select2" id="">
                                                    <option value="" selected disabled>--Select Document Type--
                                                    </option>
                                                    <option value="passport">Passport</option>
                                                    <option value="id">ID</option>
                                                    <option value="d/l">D/L</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Payment Type</label>
                                                <select name="payment_type" class="form-control select2" id="">
                                                    <option value="" selected disabled>--Select Payment Type--
                                                    </option>
                                                    <option value="cash">Cash</option>
                                                    <option value="credit">Credit</option>
                                                    <option value="card">Card</option>
                                                    <option value="ledger">City Ledger</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Board Type</label>
                                                <select name="board_type" class="form-control select2" id="">
                                                    <option value="" selected disabled>--Select Board Type--</option>
                                                    <option value="half">Half</option>
                                                    <option value="full">Full</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Place Of Birth</label>
                                                <input type="text" required name="place_birth" value=""
                                                    class="form-control" id="place_birth" placeholder="Place Of Birth">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">First Child DOB</label>
                                                <input type="date" required name="first_child_dob" value=""
                                                    class="form-control" id="first_child_dob"
                                                    placeholder="First Child DOB">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Second Child DOB</label>
                                                <input type="date" required name="sec_chhild_dob" value=""
                                                    class="form-control" id="sec_chhild_dob"
                                                    placeholder="Second Child DOB">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Infants</label>
                                                <input type="text" required name="infants" value=""
                                                    class="form-control" id="infants" placeholder="Infants">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email ID</label>
                                                <input type="email" required name="email" value=""
                                                    class="form-control" id="email" placeholder="Email ID">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Place Of Issue</label>
                                                <input type="text" required name="place_issue" value=""
                                                    class="form-control" id="place_issue" placeholder="Place OF Issue">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address" placeholder="Address"
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
        const ele = (id) => {
            return document.getElementById(id);
        }
        $(function() {

            $('#start_date').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('#start_date').on('apply.daterangepicker', function(ev, picker) {

                var start_date = picker.startDate.format('MM/DD/YYYY');
                ele('start_date').value = start_date;
                var enddate = picker.endDate.format('MM/DD/YYYY');
                ele('end_date').value = enddate;

                //calculate days
                var date1 = new Date(start_date);

                var date2 = new Date(enddate);

                var Difference_In_Time = date2.getTime() - date1.getTime();

                // To calculate the no. of days between two dates
                var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

                ele('total_days').value = Difference_In_Days;
            });


            $('#start_date').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                ele('end_date').value = '';
            });

        });

        const mutliplyamount = () => {
            ele('total_amount').value = '';
            var roomRate = ele('room_rate').value;
            var totalDays = ele('total_days').value;

            var total_amount = roomRate * totalDays;

            ele('total_amount').value = total_amount;
        }

        const guestdetail = () => {
            var startDate = ele('start_date').value;

            if (startDate) {
                ele('guest_detail').style.display = 'block';
            } else {
                toastr.error('Please Select Date Range');
            }
        }

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
                                ele('room_id').innerHTML = option;
                            }
                        }
                    }
                });
            });
        })
    </script>
@endsection
