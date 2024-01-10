@include('admin.layouts.head')

<body class="hold-transition sidebar-mini">
    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Loading ends -->
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('admin.layouts.header')
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        @include('admin.layouts.sidebar')
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('admin_main_content')
            <!-- /.content -->

        </div> <!-- /.content-wrapper -->
        @include('admin.layouts.footer')
    </div> <!-- ./wrapper -->
    <!-- ./wrapper -->


    @include('admin.layouts.script')

</body>

<!-- Mirrored from thememinister.com/health/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Sep 2023 22:49:18 GMT -->

</html>
