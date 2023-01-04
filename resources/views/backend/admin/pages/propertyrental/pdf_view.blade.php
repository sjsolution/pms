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
            margin-top: 20px;
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

        .col-sm-12 {
            width: 100%;
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

        .admin-board {
            width: 100%;
            height: auto;
        }

        .board-lft {
            width: 50%;
            height: auto;
            font-weight: 600;
            border: 1px solid black;
            font-size: 13px;
        }

        .board-lft ul {
            padding-top: 18px
        }

        .board-rt {
            width: 50%;
            height: auto;
            font-weight: 600;
            border: 1px solid black;
            font-size: 13px;
        }

        .board-rt ul {
            padding-top: 18px
        }


        @media print {
            .align-total {
                display: flex;
                -webkit-print-color-adjust: exact;
            }

            .details-rt {
                width: 50%;
                display: flex;
            }

            .details-lft {
                width: 50%;
                display: flex;
                gap: 50px;
                
            }
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
        <div class="row align-total">
            {{-- left col --}}
            <div class="details-rt">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $book = $propertyrentaldaily->start_date;
                        @endphp
                        Booking Date: &emsp;&emsp;&emsp;&emsp;{{ date('M d, Y', strtotime($book)) }}
                    </div>
                    <div class="col-md-6">
                        Flat Type: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{{ $propertyrentaldaily->flattype->name }}
                    </div>
                    <div class="col-md-6">
                        Room ID: &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;{{ $propertyrentaldaily->room->id }}
                    </div>
                    <div class="col-md-6">
                        Document No: &emsp;&emsp;&nbsp;&nbsp;&nbsp;&emsp;{{ $propertyrentaldaily->document_no }}
                    </div>
                    <div class="col-md-6">
                        Document Type: &emsp;&emsp;&emsp;{{ $propertyrentaldaily->document_type }}
                    </div>
                </div>
            </div>
            {{-- left col --}}
            {{-- Right col --}}
            <div class="details-lft">
                <div class="row">
                    <div class="col-md-6">
                        Total Amount: &emsp;&emsp;&emsp;&emsp;{{ $propertyrentaldaily->total_amount }}
                        &emsp;<span>&#65020;</span>
                    </div>
                    <div class="col-md-6">
                        @foreach ($propertyrentaldaily->paymenttrack as $item)
                            {{ $item->date }}&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;{{ $item->amount }}&emsp;&emsp;<span>&#65020;</span>
                            <br>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        Total Amount Paid: &emsp;&emsp;{{ $propertyrentaldaily->paymenttrack->sum('amount') }}
                        &emsp;&nbsp;&nbsp;<span>&#65020;</span>
                    </div>
                    <div class="col-md-6">
                        <hr class="solid1">
                    </div>
                    <div class="col-md-6">
                        @php
                            $remain = $propertyrentaldaily->total_amount - $propertyrentaldaily->paymenttrack->sum('amount');
                        @endphp
                        Remaining: &emsp;&emsp;&emsp;&emsp;&emsp;{{ $remain }} &emsp;&emsp;<span>&#65020;
                    </div>
                </div>
            </div>
            {{-- Right col --}}
        </div>
        <hr class="solid1">
        <footer>
            <div class="row admin-board">
                <div class="board-lft">
                    <ul>
                        <li> WE ARE KINDLY INFORMING YOU THAT
                            CHECK OUT TIME IS 12 NOON.</li>
                        <li>THE HOTEL IS NOT RESPONSIBLE FOR
                            ACCIDENTS OR INJURIES THAT OCCUR
                            TO GUESTS, LOSS OF MONEY JEWELLERY OR ANY
                            KIND OF VALUABLE ITEMS.</li>
                        <li>GUEST WILL BE RESPONSIBLE
                            FOR ANY DAMAGE TO THE HOTEL OR FURNITURE
                            DURING THE THE STAY AT THE HOTEL.</li>

                    </ul>
                </div>
                <div class="board-rt">
                    <ul>
                        <li>نحن نتفضل إخبإركم نن وعد لموار ك وع ون لمالرد 12 إلمى
                            2 ظهكل</li>
                        <li>لمفن ق ميس واللع دن لمحعل ث لمتي تح ث ملنزأل لع فق لن
                            لألوعل نع لموجعوكلت نع لي ون لالشيرء لمثوينة</li>
                        <li>مإنزي الع يمعن واللع دن ني نضلكلك إرمفن ق نع لألثرث
                            نثنرء فتكة لألقروة إرمفن ق</li>

                    </ul>
                </div>
            </div>
            
            <div style="position:relative; margin-top:50px">
                <div style="position:absolute;"><b><u>Customer Signature</u></b></div>
                <div style="position:absolute; right:10px;"><b><u>For Office Use</u></b></div>
            </div>
        </footer>
    </div>


    @include('backend.admin.layouts.scripts')
</body>

</html>
