@extends('backend.admin.layouts.master')
@section('title', 'Property List')
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
                                            <a href="{{ route('admin.room.create') }}" class="btn btn-primary"
                                                style="float: left">ADD+</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Building Name</th>
                                                <th>Flat Type</th>
                                                <th>Room</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($room as $row)
                                                <tr>
                                                    <input type="hidden" class="delete_val" value="{{ $row->id }}">
                                                    <td>{{ $row->id }}</td>
                                                    <td>{{ $row->building->name }}</td>
                                                    <td>{{ $row->flattype->name }}</td>
                                                    <td>{{ $row->room_no }}</td>
                                                    <td> <label class="switch"><input type="checkbox"
                                                                {{ $row->status == 1 ? 'checked' : '' }} id="togBtn"
                                                                data-id="{{ $row->id }}"
                                                                onchange="updateStatus(event)">
                                                            <div class="slider round">
                                                                <!--ADDED HTML -->

                                                                <span class="on">Vacant</span>

                                                                <span class="off">Occupied</span>


                                                                <!--END-->
                                                            </div>
                                                        </label></td>
                                                    <td><a href="{{ route('admin.room.edit', $row->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-pencil-alt"
                                                                aria-hidden="true"></i></a>
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
                                "_token": $('input[name="csrf-token"]').val(),
                                "id": delete_id,
                            };

                            $.ajax({
                                type: "DELETE",
                                url: get_url(
                                    "{{ route('admin.room.destroy', 'item_id') }}",
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

        function updateStatus(e) {
            var id = $(e.target).data('id');
            $.ajax({
                method: "GET",
                url: get_url("{{ route('admin.property.status', 'item_id') }}", id),
                success: function(response) {
                    if (response.status == 1 || response.status == 0) {
                        toastr.success("Status updated successfuly!");
                    } else {
                        toastr.error('Something Went Wrong.');
                        window.setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            }).always(function(jqXHR, textStatus) {
                if (textStatus != "success") {
                    alert("Error: " + jqXHR.statusText);
                    location.reload();
                }
            });
        }
    </script>
    <script>
        $("#allcheck").click(function() {
            if ($("#allcheck").prop("checked") == true) {
                $('input:checkbox').prop('checked', true);
            } else if ($("#allcheck").prop("checked") == false) {
                $('input:checkbox').prop('checked', false);
            }
        });

        function addStatus(status) {
            $("#changeStatus").val(status)
            if ($('.customchkbox:checked').length > 0) {
                if (status == "delete") {
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result == true) {
                            $("#target").submit();
                        }
                    });
                }
            } else {
                swal({
                    title: "Error",
                    text: 'Please select checkbox',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    // if (result.isConfirmed) {
                    //     location.reload();
                    // }
                });
            }
        }
    </script>
@endsection
