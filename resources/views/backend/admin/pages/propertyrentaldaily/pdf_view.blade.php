<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .building {
            margin-top: 90px;
            text-align: center;
            font-size: 30px;
            color: LightGray;
            font-weight: bolder;
        }

        hr.solid {
            border-top: 2px solid rgb(0, 0, 0);
        }

        hr.solid1 {
            border-top: 2px solid black;
        }

        .row {
            clear: both;
        }

        .col-md-4 {
            width: 30%;
            float: left;
        }

        .col-md-12 {
            width: 100%;
            float: left;
        }

        .col-md-2 {
            width: 20%;
            float: left;
        }

        p {
            font-size: 16px;
        }

        .font-size {
            font-size: 17px;
            font-weight: 600
        }

        .guest {
            color: LightGray;
        }

        .company {
            font-size: 22px;
            color: lightgray;
        }

        .date {
            font-size: 29px;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <div class="container-fluid">
        <div class="row" class="">
            <div class="col-md-12">
                <h1 class="building">{{ $propertyrentaldaily->building->name }}</h1>
            </div>
        </div>
        <hr class="solid">
        <div class="row">
            <div class="col-md-12">
                <h5> <span class="guest">Guest Name</span> <strong>{{ $propertyrentaldaily->name }}</strong></h5>
            </div>
        </div>
        <hr class="solid">
        <div class="row">
            <div class="col-md-4">
                <p class="company">{{ $propertyrentaldaily->company_name }}</p>
            </div>
            <div class="col-md-4">
                <label for="" class="company">Check-In Date</label>
                @php
                    $date = $propertyrentaldaily->start_date;
                @endphp
                <p class="date">{{ date('M d, Y', strtotime($date)) }}</p>
            </div>
            <div class="col-md-4">
                <label for="" class="company">Check-Out Date</label>
                @php
                    $enddate = $propertyrentaldaily->end_date;
                @endphp
                <p class="date">{{ date('M d, Y', strtotime($enddate)) }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @php
                    //This function is used to create EXCEL
                    function breakStr($string, $length)
                    {
                        $stringAry = wordwrap($string, $length, '<br/>');
                        return $stringAry;
                    }
                    
                    $add = $propertyrentaldaily->address;
                @endphp
                <p class="break-1">{!! breakStr($add, 30) !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>Ph no: {{ $propertyrentaldaily->mobile_no }}</p>
            </div>
        </div>
        <hr class="solid1">
        <div class="row">
            <div class="col-md-4">
                <p>Booking Date:</p>
            </div>
            <div class="col-md-4">
                @php
                    $book = $propertyrentaldaily->start_date;
                @endphp
                <p class="font-size">{{ date('M d, Y', strtotime($book)) }}</p>
            </div>
            <div class="col-md-2">
                <p>Total Amount:</p>
            </div>
            <div class="col-md-2">
                <p>{{ $propertyrentaldaily->total_amount }} Rs.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>Flat Type:</p>
            </div>
            <div class="col-md-4">
                <p class="font-size">{{ $propertyrentaldaily->flattype->name }}</p>
            </div>
            <div class="col-md-2">
                <p>Amount Paid:</p>
            </div>
            <div class="col-md-2">
                <p>{{ $propertyrentaldaily->advance }} Rs.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>Room ID:</p>
            </div>
            <div class="col-md-4">
                <p class="font-size">{{ $propertyrentaldaily->room->id }}</p>
            </div>
            <div class="col-md-4">
                <hr class="solid1">
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <p>Document No:</p>
            </div>
            <div class="col-md-4">
                <p class="font-size">{{ $propertyrentaldaily->document_no }}</p>
            </div>
            <div class="col-md-2">
                <p>Remaining:</p>
            </div>
            <div class="col-md-2">
                @php
                    $remain = $propertyrentaldaily->total_amount - $propertyrentaldaily->advance;
                @endphp
                <p>{{ $remain }} Rs.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>Document Type:</p>
            </div>
            <div class="col-md-4">
                <p class="font-size">{{ $propertyrentaldaily->document_type }}</p>
            </div>
        </div>
        <hr class="solid1">
    </div>

    @include('backend.admin.layouts.scripts')
</body>

</html>
