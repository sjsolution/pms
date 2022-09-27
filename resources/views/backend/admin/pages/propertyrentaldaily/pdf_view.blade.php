<!DOCTYPE html>
<html lang="en">
@include('backend.admin.layouts.head')
<style>
    .building {
        margin-top: 250px;
        text-align: center;
    }

    hr.solid {
        border-top: 3px solid #bbb;
    }

    .row {
        clear: both;
    }

    .col-md-4 {
        width: 33%;
        float: left;
    }

    .col-md-12 {
        width: 100%;
        float: left;
    }
</style>

<body>
    <div class="content-wrapper">
        <div class="row" class="building">
            <div class="col-md-12">
                <h1>{{ $propertyrentaldaily->building->name }}</h1>
            </div>
        </div>
        <hr class="solid">
        <div class="row">
            <div class="col-md-12">
                <h5>Guest Name <strong>{{ $propertyrentaldaily->name }}</strong></h5>
            </div>
        </div>
        <hr class="solid">
        <div class="row">
            <div class="col-md-4">
                <h2>{{ $propertyrentaldaily->company_name }}</h2>
            </div>
            <div class="col-md-4">
                <label for="">Check-In Date</label>
                <p>{{ $propertyrentaldaily->start_date }}</p>
            </div>
            <div class="col-md-4">
                <label for="">Check-Out Date</label>
                <p>{{ $propertyrentaldaily->end_date }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>{{ $propertyrentaldaily->address }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Ph no: {{ $propertyrentaldaily->mobile_no }}</p>
            </div>
        </div>
        <hr class="solid">
        <div class="row">
            <div class="col-md-3">
                <p>Booking Date:</p>
            </div>
            <div class="col-md-3">
                <p>{{ $propertyrentaldaily->start_date }}</p>
            </div>
            <div class="col-md-3">
                <p>Total Amount:</p>
            </div>
            <div class="col-md-3">
                <p>{{$propertyrentaldaily->total_amount}} Rs.</p>
            </div>
        </div>
    </div>

    @include('backend.admin.layouts.scripts')
</body>

</html>
