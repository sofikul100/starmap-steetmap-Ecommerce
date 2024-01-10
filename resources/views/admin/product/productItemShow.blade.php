@extends('admin.master')
@section('backend_title')
   View-Product
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
            <i class="fa fa-cube"></i>
        </div>
        <div class="header-title">
            <h1> View Product</h1>
            <small>View Product Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('product.index') }}"><i class="pe-7s-home"></i> Product List</a></li>
                <li class="active">View Product</li>
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
                            <a type="button" href="{{ route('product.index') }}"
                            class="btn btn-labeled btn-black m-b-5">
                            <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Product List
                           </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                              <table class="table table-bordered">
                                   <thead>
                                      <th>Product Title</th>
                                      <th>Product Code</th>
                                      <th>Category</th>
                                      <th>Subcategory</th>
                                   </thead>
                                   <tbody>
                                       <tr>
                                         <td>{{ ucwords($product->product_title) }}</td>
                                         <td>#{{ $product->product_code }}</td>
                                         
                                         <td>--- {{ ucwords($product->categoy->categoy_name) }} ---</td>
                                         <td>
                                            @if (empty($product->Subcategory->subcategory_name))
                                            <span class="text-danger">Empty</span>
                                           @else
                                           - {{ ucwords($product->Subcategory->subcategory_name)   }} -
                                           @endif
                                         </td>   
                                       </tr>
                                   </tbody>
                                   <thead>
                                       <th>Brand</th>
                                       <th>Selling Price</th>
                                       <th>Discount Price</th>
                                       <th>Video Url</th>
                                   </thead>
                                   <tbody>
                                       <tr>
                                         <td>
                                            @if (empty($product->brand))
                                            <span class="text-danger">Empty</span>
                                           @else
                                            {{ ucwords($product->Brand->name)   }} 
                                           @endif
                                         </td>
                                         <td>{{ $product->selling_price }}</td>
                                         <td>{{ $product->discount_price }}</td>
                                         <td>
                                            @if (empty($product->video_url))
                                            Empty
                                           @else
                                           {{ ucwords($product->video_url)   }}
                                           @endif
                                         </td>
                                       </tr>
                                   </tbody>
                                   <thead>
                                       <th colspan="1">Main Thumbnail</th>
                                       <th colspan="3">Product Images</th>
                                   </thead>
                                   <tbody>
                                       <tr>
                                        
                                              <td colspan="1"><img src="{{ asset('') }}{{ $product->main_thumbnail }}" style="border-radius: 10px"  alt="Product Image"
                                            height="150" width="200"></td>

                                            <td colspan="3">
                                                @forelse ($product->productImage as $image)
                                                <img src="{{ asset('') }}{{ $image->product_image }}" style="border-radius: 10px"  alt="Product Image"
                                                height="100" width="100">
                                                @empty
                                                    <span class="text-danger">No Images Found!</span>
                                                @endforelse
                                            </td>
                                         
                                       </tr>
                                   </tbody>
                              </table>
                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
@endsection
