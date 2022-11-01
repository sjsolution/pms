@extends('backend.admin.layouts.master')
@section('title')
    {{ __('Terms & Conditions') }}
@endsection
@section('style')
    <style>
        .admin-board {
            width: 100%;
            height: auto;
        }

        .board-lft {
            width: 50%;
            height: auto;
            font-weight: 600;
            border: 1px solid black;
        }

        .board-lft ul{
            padding-top: 18px
        }

        .board-rt{
            width: 50%;
            height: auto;
            font-weight: 600;
            border: 1px solid black;
        }

        .board-rt ul{
            padding-top: 18px
        }

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Terms and Conditions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Terms and Conditions</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row admin-board">
                    <div class="board-lft">
                        <ul>
                            <li> WE ARE KINDLY INFORMING YOU THAT
                                CHECK OUT TIME IS FROM 12 NOON TO 2 PM.</li>
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
            </div>
        </section>
    </div>
@endsection
