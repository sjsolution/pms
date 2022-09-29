@extends('backend.admin.layouts.master')
@section('title', 'Document List')
@section('content')
    <script>
        const ele = (id) => {
            return document.getElementById(id);
        }

        function loadData2(document) {
            var document = JSON.parse(document);
            //calculate days
            var date1 = new Date();
            var date2 = new Date(document.expiry_date);
            var Difference_In_Time = date2.getTime() - date1.getTime();

            //To calculate the no. of days between two dates
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            if (Difference_In_Days <= document.days_alert) {
                $('#expiremodal').modal('show');

                var text = `Your Document with title ${document.title} will expire after ${document.days_alert} days.`;

                ele('modaltext').innerText = text;

            }

        }
    </script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Documents</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Documents</li>
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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <a href="{{ route('admin.document.create') }}" class="btn btn-primary"
                                            style="float: left">ADD+</a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Expiry Date</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($document as $row)
                                            <tr>
                                                <input type="hidden" class="delete_val" value="{{ $row->id }}">
                                                <td>{{ $row->title }}</td>
                                                <td>{{ $row->expiry_date }}</td>
                                                <td><a class="btn btn-info"
                                                        href="{{ URL::asset('public/documents/' . $row->image) }}"
                                                        target="_blank"><i class="fas fa fa-eye" aria-hidden="true"></i></a>
                                                </td>
                                                <td><a href="{{ route('admin.document.edit', $row->id) }}"
                                                        class="btn btn-primary"><i class="fas fa-pencil-alt"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="btn btn-danger dltbtn"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <iframe style="display: none" onload="loadData2(`{{ $row }}`)"
                                                frameborder="0"></iframe>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="expiremodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Document Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modaltext"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
                                    "{{ route('admin.document.destroy', 'item_id') }}",
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

        //expire alert script
    </script>
@endsection
