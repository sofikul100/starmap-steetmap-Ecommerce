@extends('admin.master')
@section('backend_title')
   Brand-Edit
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
            <i class="fa fa-certificate" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1> Edit Brand</h1>
            <small>Edit Brand Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('brand.index') }}"><i class="pe-7s-home"></i> Brand List</a></li>
                <li class="active">Edit Brand</li>
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
                            <a type="button" href="{{ route('brand.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                </span>Back To Brand List
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                                 <form action="{{ route('brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="name">Brand Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ $brand->name }}" id="category_name" required class="form-control" placeholder="Enter Brand Name">
                                        </div>
                                        @error('name')
                                          <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="brand_image">New Brand Image</label>
                                            <input type="file" name="brand_image" id="brand_image" class="form-control">
                                        </div>
                                        @error('brand_image')
                                        <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-success btn-sm" id="form_submit_button"><i class="fa fa-wrench" aria-hidden="true"></i>
                                                 Update</button>
                                        </div>
                                    </div>
                                 </form>

                        </div>
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
    $(document).ready(function(){
       $(".error_text").delay(5000).slideUp(300);
   });
 </script>
@endsection
