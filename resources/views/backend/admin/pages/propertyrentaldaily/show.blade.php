@extends('backend.admin.layouts.master')
@section('title', 'Property Rental show')
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Room Detail</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Building</label>
                                            <input type="text" readonly class="form-control"
                                                value="{{ isset($propertyrentaldaily->building->name) ? $propertyrentaldaily->building->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>FlatType</label>
                                            <input type="text" readonly class="form-control"
                                                value="{{ isset($propertyrentaldaily->flattype->name) ? $propertyrentaldaily->flattype->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Room</label>
                                            <input type="text" readonly class="form-control"
                                            value="{{ isset($propertyrentaldaily->room->room_no) ? $propertyrentaldaily->room->room_no : '' }}">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_days">Total Days</label>
                                            <input type="text" readonly name="total_days" value="{{isset($propertyrentaldaily->total_days) ? $propertyrentaldaily->total_days: ''}}" class="form-control"
                                                id="total_days" placeholder="Total Days">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Start Date</label>
                                            <input type="text" readonly id="start_date" name="start_date" class="form-control"
                                                value="{{isset($propertyrentaldaily->start_date) ? $propertyrentaldaily->start_date: ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">End Date</label>
                                        <input type="text" id="end_date" readonly name="end_date" class="form-control"
                                            value="{{isset($propertyrentaldaily->end_date) ? $propertyrentaldaily->end_date: ''}}" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_amount">Total Amount</label>
                                            <input type="text" required name="total_amount" readonly value="{{isset($propertyrentaldaily->total_amount) ? $propertyrentaldaily->total_amount: ''}}"
                                                class="form-control" id="total_amount" placeholder="Total Amount">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="advance">Advance Payment</label>
                                            <input type="text" required name="advance" readonly value="{{isset($propertyrentaldaily->advance) ? $propertyrentaldaily->advance: ''}}"
                                                class="form-control" id="advance" placeholder="Advance Payment">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="room_rate">Room Rate</label>
                                            <input type="text" required name="room_rate" readonly value="{{isset($propertyrentaldaily->room_rate) ? $propertyrentaldaily->room_rate: ''}}"
                                                class="form-control" id="room_rate" 
                                                placeholder="Advance Payment">

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
                                            <label for="">Guest Full Name</label>
                                            <input type="text" required name="name" readonly value="{{isset($propertyrentaldaily->name) ? $propertyrentaldaily->name: ''}}"
                                                class="form-control" id="name" placeholder="Guest Full Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">No. Of PAX</label>
                                            <input type="text" required name="pax" readonly value="{{isset($propertyrentaldaily->pax) ? $propertyrentaldaily->pax: ''}}"
                                                class="form-control" id="pax" placeholder="No. Of PAX">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Vehicle</label>
                                            <input type="text" required name="vehicle" readonly value="{{isset($propertyrentaldaily->vehicle) ? $propertyrentaldaily->vehicle: ''}}"
                                                class="form-control" id="vehicle" placeholder="Vehicle">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Mobile No</label>
                                            <input type="text" required name="mobile_no" readonly value="{{isset($propertyrentaldaily->mobile_no) ? $propertyrentaldaily->mobile_no: ''}}"
                                                class="form-control" id="mobile_no" placeholder="Mobile No">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Document No</label>
                                            <input type="text" required name="document_no" readonly value="{{isset($propertyrentaldaily->document_no) ? $propertyrentaldaily->document_no: ''}}"
                                                class="form-control" id="document_no" placeholder="Document No">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Date Of Expiry</label>
                                            <input type="text" required name="expiry_date" readonly value="{{isset($propertyrentaldaily->expiry_date) ? $propertyrentaldaily->expiry_date: ''}}"
                                                class="form-control" id="expiry_date" placeholder="Date Of Expiry">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nationality</label>
                                            <input type="text" required name="nationality" readonly value="{{isset($propertyrentaldaily->nationality) ? $propertyrentaldaily->nationality: ''}}"
                                                class="form-control" id="nationality" placeholder="Nationality">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Company Name</label>
                                            <input type="text" required name="company_name" readonly value="{{isset($propertyrentaldaily->company_name) ? $propertyrentaldaily->company_name: ''}}"
                                                class="form-control" id="company_name" placeholder="Company Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Date Of Birth</label>
                                            <input type="text" required name="dob" readonly value="{{isset($propertyrentaldaily->dob) ? $propertyrentaldaily->dob: ''}}"
                                                class="form-control" id="dob" placeholder="Date Of Birth">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Document Type</label>
                                            <input type="text" class="form-control" readonly name="" value="{{isset($propertyrentaldaily->document_type) ? $propertyrentaldaily->document_type: ''}}" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Payment Type</label>
                                          <input type="text" class="form-control" readonly name="" value="{{isset($propertyrentaldaily->payment_type) ? $propertyrentaldaily->payment_type: ''}}" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Board Type</label>
                                            <input type="text" class="form-control" readonly value="{{isset($propertyrentaldaily->board_type) ? $propertyrentaldaily->board_type: ''}}"  name="" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Place Of Birth</label>
                                            <input type="text" required name="place_birth" readonly value="{{isset($propertyrentaldaily->place_birth) ? $propertyrentaldaily->place_birth: ''}}"
                                                class="form-control" id="place_birth" placeholder="Place Of Birth">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">First Child DOB</label>
                                            <input type="text" required name="first_child_dob" readonly value="{{isset($propertyrentaldaily->first_child_dob) ? $propertyrentaldaily->first_child_dob: ''}}"
                                                class="form-control" id="first_child_dob" placeholder="First Child DOB">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Second Child DOB</label>
                                            <input type="text" required name="sec_chhild_dob" readonly value="{{isset($propertyrentaldaily->sec_chhild_dob) ? $propertyrentaldaily->sec_chhild_dob: ''}}"
                                                class="form-control" id="sec_chhild_dob" placeholder="Second Child DOB">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Infants</label>
                                            <input type="text" required name="infants" readonly value="{{isset($propertyrentaldaily->sec_chhild_dob) ? $propertyrentaldaily->sec_chhild_dob: ''}}"
                                                class="form-control" id="infants" placeholder="Infants">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" required name="email" readonly value="{{isset($propertyrentaldaily->sec_chhild_dob) ? $propertyrentaldaily->sec_chhild_dob: ''}}"
                                                class="form-control" id="email" placeholder="Email ID">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Place Issue</label>
                                            <input type="text" required name="place_issue" readonly value="{{isset($propertyrentaldaily->sec_chhild_dob) ? $propertyrentaldaily->sec_chhild_dob: ''}}"
                                                class="form-control" id="place_issue" placeholder="Place OF Issue">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" readonly value="{{isset($propertyrentaldaily->address) ? $propertyrentaldaily->address: ''}}" placeholder="Address"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end guest detail --}}

            </div>
        </section>
    </div>
@endsection
