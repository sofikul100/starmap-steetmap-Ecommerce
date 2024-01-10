@extends('admin.master')
@section('backend_title')
    Category-Add
@endsection

@section('admin_main_content')
    <section class="content-header">
        <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <div class="header-icon">
            <i class="fa fa-ticket"></i>
        </div>
        <div class="header-title">
            <h1> Add New Coupon</h1>
            <small>Add Coupon Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('coupon.index') }}"><i class="pe-7s-home"></i> Coupon List</a></li>
                <li class="active">Add Coupon</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag panel-primary">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <a type="button" href="{{ route('coupon.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Coupon List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="coupon_name">Coupon Name<span class="text-danger">*</span></label>
                                        <input type="text" name="coupon_name" id="coupon_name" required class="form-control"
                                            placeholder="Enter Coupon Name">
                                        @error('coupon_name')
                                            <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-6">
                                        <label for="coupon_code">Coupon Code<span class="text-danger">*</span></label>
                                        <input type="text" name="coupon_code" id="coupon_code" required class="form-control"
                                            placeholder="Enter Coupon Code">
                                        @error('coupon_code')
                                            <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="spacer"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="start_date">Start Date<span class="text-danger">*</span></label>
                                        <input type="date" name="start_date" id="start_date" required class="form-control">
                                        @error('start_date')
                                            <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="end_date">Expire Date<span class="text-danger">*</span></label>
                                        <input type="date" name="end_date" id="end_date" required class="form-control">
                                        @error('end_date')
                                            <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                               

                               <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-labeled btn-success m-b-5 update_button">
                                            <span class="btn-label"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </span>Add Now
                                        </button>
                                    </div>
                                </div>
                               </div>
                            </form>

                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".error_text").delay(5000).slideUp(300);
        });
    </script>
@endsection
