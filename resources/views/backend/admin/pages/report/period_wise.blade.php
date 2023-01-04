@extends('backend.admin.layouts.master')
@section('title', 'Cashier Report')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cashier Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
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
                        <div class="card">
                            @if (Session::has('msg'))
                                <div class="col-md-12">
                                    <div class="alert alert-success" style="margin-top: 5px">{{ Session::get('msg') }}</div>
                                </div>
                            @endif
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            @if (Auth::user()->hasRole('admin'))
                                                <label>Select Building (Drop Down)</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="building_id" id="building_id"
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
                                                <input type="hidden" name="building_id" id="building_id"
                                                    value="{{ isset($building->id) ? $building->id : '' }}" id="">
                                                <input type="text" readonly class="form-control"
                                                    value="{{ isset($building->name) ? $building->name : '' }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Select Date</label>
                                            <input type="text" name="datefilter" id="datefilter" class="form-control"
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <button type="submit" class="btn btn-info" style="margin-top: 31px"
                                                onclick="periodwise();">Search</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Flat no</th>
                                            <th>Guest Name</th>
                                            <th>Check IN/Out</th>
                                            <th>Cash</th>
                                            <th>Credit Card</th>
                                            <th>City Ledger</th>
                                            <th>Others</th>
                                            <th>Additional Charges</th>
                                            <!--<th>Payable</th>-->
                                            <!--<th>Receiveable</th>-->
                                            <!--<th>Additional Charges</th>-->
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>

                                </table>
                                <br>
                                 <div class="row">
                                    <div class="col-md-6">
                                        
                                    </div>
                                    <div class="col-md-2" id="payment_total" style="float: right;">

                                    </div>
                                    <div class="col-md-2" id="cash_total" style="float: right;">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        
                                    </div>
                                    <div class="col-md-2" id="sub_total" style="float: right;">

                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-10">
                                        
                                    </div>
                                    <div class="col-md-2" id="grand_total" style="float: right;">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        
                                    </div>
                                    <div class="col-md-2" id="grand_total" style="float: right;">

                                    </div>
                                </div>
                                
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });


        const periodwise = () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = {
                "_token": "{{ csrf_token() }}",
                "building_id": ele('building_id').value,
                "datefilter": ele('datefilter').value
            };
            $.ajax({
                type: "POST",
                url: "{{ route('admin.report.periodwise') }}",
                data: data,
                success: function(response) {
                    console.log(response)
                    var len = 0;
                    
                    // var sub_total = `<p><strong>Sub Total: </strong>${response.total}</p>`; 
                     
                    // ele('sub_total').innerHTML = sub_total;
                    
                    if (response.property) {
                        len = response['property'].length;
                    }

                    var cash_payment = 0;
                    var card_payment = 0;
                    var other_payment = 0;
                    var ledger = 0;
                    var total_payable = 0;
                    var total_additional = 0;
                
                    ele('tbody').innerHTML = '';
                    if (len > 0) {
                        // Read data and create <option >
                        for (var i = 0; i < len; i++) {
                            var id = response['property'][i].id;
                            var dated_at = response['property'][i].created_at;
                            var d = new Date(dated_at);
                            var dated_at = d.getDate()  + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
                            
                            var flat_type = response['property'][i].room.room_no;
                            var property_rental = response['property'][i].property_rental;
                            var name = response['property'][i].name;
                            var status = response['property'][i].status;
                            var payable = response['property'][i].paymenttrack_sum_amount;
                            var charges = response['property'][i].charges?.additional_charges;
                            var payment_type = response['property'][i].payment_type;
                            
                            total_payable += payable != null && payable != NaN ? parseFloat(payable) : 0;
                            
                            cash_payment += payment_type=="cash" && payable != NaN && payable != null ? parseFloat(payable) : 0;
                            card_payment += payment_type=="card" && payable != NaN && payable != null ? parseFloat(payable) : 0;
                            other_payment += payment_type=="others" && payable != NaN && payable != null ? parseFloat(payable) : 0;
                            ledger += payment_type=="ledger" && payable != NaN && payable != null ? parseFloat(payable) : 0;
                            total_additional += charges != null && charges != undefined ? parseFloat(charges) : 0;
                           
                            if (charges == undefined) {
                                var charges = '0';
                            }
                            if(payable == null){
                                var payable = '0';
                            }    
                            var total_amount = response['property'][i].total_amount;
                            if (payable == total_amount) {
                                var receiveable = '0';
                            } else {
                                var receiveable = total_amount - payable;
                            }
                            if (status == 1) {
                                var status = `<span class="badge badge-success">Checked-In </span>`;
                            } else {
                                var status = `<span class="badge badge-danger">Checked Out</span>`;
                            }
                            var amount = response['property'][i].property_rental;
                            
                            var html = `<tr>
                                <td>${dated_at}</td>
                                <td>${flat_type}</td>
                                <td>${name}</td>
                                <td>${status}</td>
                                <td>${payment_type=="cash" ? payable : 0}</td>
                                <td>${payment_type=="card" ? payable : 0}</td>
                                <td>${payment_type=="ledger" ? payable : 0}</td>
                                <td>${payment_type=="others" ? payable : 0}</td>
                                <td>${charges}</td>
                            </tr>`;
                            ele('tbody').innerHTML += html;
                        }
                        
                    }
                    var html = `<tr>
                        <td colspan="4"></td>
                        <td><strong>Total: </strong>${cash_payment}</td>
                        <td><strong>Total: </strong>${card_payment}</td>
                        <td><strong>Total: </strong>${ledger}</td>
                        <td><strong>Total: </strong>${other_payment}</td>
                        <td><strong>Total: </strong>${total_additional}</td>
                    </tr>`;
                    ele('tbody').innerHTML += html;
                    var total = cash_payment + card_payment + ledger + other_payment + total_additional;
                    var grand_total = `<p><strong>Grand Total: </strong>${total}</p>`;
                    ele('grand_total').innerHTML = grand_total;
                    // ele('payment_total').innerHTML = `<p><strong>Total: </strong>${total_payable}</p>`;
                    // ele('cash_total').innerHTML = `<p><strong>Cash Total: </strong>${cash_payment}</p>`;
                }

            });
        }

    </script>
@endsection
