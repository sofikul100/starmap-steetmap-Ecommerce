@extends('admin.master')
@section('backend_title')
   Sub-Category-Edit
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
            <i class="fa fa-folder-open" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1> Edit Sub-Category</h1>
            <small>Edit Sub-Category Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('subcategory.index') }}"><i class="pe-7s-home"></i> SubCategory List</a></li>
                <li class="active">Edit SubCategorie</li>
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
                            <a type="button" href="{{ route('subcategory.index') }}"
                            class="btn btn-labeled btn-black m-b-5">
                            <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Subcategory List
                        </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                                 <form action="{{ route('subcategory.update',$subcategorie->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="category_id">Category Name <span class="text-danger">*</span> </label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="" disabled selected>--Select Category--</option>
                                                @forelse ($categories as $category)
                                                  <option value="{{ $category->id }}" {{ $category->id == $subcategorie->category_id ? 'selected':'' }} >{{ ucwords($category->categoy_name) }}</option>
                                                @empty
                                                 <option disabled class="text-danger">No Category Found!</option>
                                                @endforelse
                                               
                                            </select>
                                        </div>
                                        @error('category_id')
                                          <p class="text-danger error_text">{{ $message }}</p>
                                        @enderror 
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="subcategory_name">Subcategory Name<span class="text-danger">*</span></label>
                                            <input type="text" name="subcategory_name" value="{{ $subcategorie->subcategory_name }}" id="subcategory_name" required class="form-control" placeholder="Subcategory Name...">
                                        </div>
                                        @error('subcategory_name')
                                        <p class="text-danger error_text">{{ $message }}</p>
                                      @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <label for="subcategory_image">Subcategory New Image</label>
                                            <input type="file" name="subcategory_image" id="subcategory_image"  class="form-control">
                                        </div>
                                        @error('subcategory_image')
                                        <p class="text-danger error_text">{{ $message }}</p>
                                      @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-success btn-sm" id="form_submit_button"> <i class="fa fa-wrench" aria-hidden="true"></i> Update</button>
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
