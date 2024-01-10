@extends('admin.master')
@section('backend_title')
   Category-Edit
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
            <i class="fa fa-folder"></i>
        </div>
        <div class="header-title">
            <h1> Edit Category</h1>
            <small>Edit Category Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('category.index') }}"><i class="pe-7s-home"></i> Category List</a></li>
                <li class="active">Edit Categorie</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <a type="button" href="{{ route('category.index') }}"
                            class="btn btn-labeled btn-dark m-b-5">
                            <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Category List
                        </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                                 <form action="{{ route('category.update',$categorie->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="category_name">Category Name<span class="text-danger">*</span></label>
                                            <input type="text" name="category_name" value="{{ $categorie->categoy_name }}" id="category_name" required class="form-control" placeholder="Enter Category Name">
                                        </div>
                                        @error('category_name')
                                          <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="category_image">Category Image</label>
                                            <input type="file" name="category_image" id="category_image" class="form-control">
                                        </div>
                                        @error('category_image')
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
