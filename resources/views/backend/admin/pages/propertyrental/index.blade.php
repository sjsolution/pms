@extends('backend.admin.layouts.master')
@section('title', 'Property Rentals')
@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 90px;
            height: 34px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2ab934;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(55px);
            -ms-transform: translateX(55px);
            transform: translateX(55px);
        }

        /*------ ADDED CSS ---------*/
        .on {
            display: none;
        }

        .on {
            color: white;
            position: absolute;
            transform: translate(-70%, -50%);
            top: 50%;
            left: 50%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        .off {
            color: white;
            position: absolute;
            transform: translate(-30%, -50%);
            top: 50%;
            left: 50%;
            font-size: 10px;
            font-family: Verdana, sans-serif;
        }

        input:checked+.slider .on {
            display: block;
        }

        input:checked+.slider .off {
            display: none;
        }

        /*--------- END --------*/

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mediciens List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Properties</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (Session::has('msg'))
                                <div class="col-md-12">
                                    <div class="alert alert-success" style="margin-top: 5px">{{ Session::get('msg') }}</div>
                                </div>
                            @endif
                            <form action="{{ route('admin.property.bulk-action') }}" method="post" id="target">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <a href="{{ route('admin.property.create') }}" class="btn btn-primary"
                                                style="float: left">ADD+</a>
                                        </div>
                                        @if (isset($property) && $property->count() > 0)
                                            <input type="hidden" id="changeStatus" name="status" value="">
                                            <div class="col-md-4 text-right">
                                                <a class="btn btn-danger" onclick="addStatus('delete')"
                                                    style="margin-left: 18px;">Delete</a>
                                            </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Building Name</th>
                                                <th>Flat Type</th>
                                                <th>Flat no</th>
                                                <th>Name</th>
                                                <th>Rent Date</th>
                                                <th>Contract Start</th>
                                                <th>Contract Expires</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($propertyrental as $row)
                                                <tr>
                                                    <input type="hidden" class="delete_val" value="{{ $row->id }}">
                                                    <td>{{ $row->building->name }}</td>
                                                    <td>{{ $row->flattype->name }}</td>
                                                    <td>{{ $row->room->room_no }}</td>
                                                    <td>{{ $row->tenant_name }}</td>
                                                    <td>{{ $row->rent_due_date }}</td>
                                                    <td>{{ $row->contract_start }}</td>
                                                    <td>{{ $row->contract_expire }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger dltbtn"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
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
    <!-- /.content-wrapper -->
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
        const get_url = (url, id) => {
            return url.replace('item_id', id);
        }
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dltbtn').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest("tr").find('.delete_val').val();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            var data = {
                                "_token": "{{ csrf_token() }}",
                                "id": delete_id,
                            };

                            $.ajax({
                                type: "DELETE",
                                url: get_url(
                                    "{{ route('admin.propertyrental.destroy', 'item_id') }}",
                                    delete_id),
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });

                                }

                            });


                        }
                    });


            });
        });

    </script>
@endsection
