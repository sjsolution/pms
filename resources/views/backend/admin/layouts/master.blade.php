<!DOCTYPE html>
<html lang="en">
@include('backend.admin.layouts.head')
@yield('style')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('backend.admin.layouts.header')

        @include('backend.admin.layouts.sidebar')

        @yield('content')

        @include('backend.admin.layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('backend.admin.layouts.scripts')
</body>

</html>
