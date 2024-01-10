@extends('admin.master')
@section('backend_title')
    Product-Trashed-Items
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
            <i class="fa fa-cube text-danger" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1 class="text-danger">Product Trashed Items</h1>
            <small> Product  Trashed Items Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('product.index') }}"><i class="pe-7s-home"></i> Product List</a></li>
                <li class="active">Trashed Items</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag panel-danger">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <a type="button" href="{{ route('product.index') }}"
                                class="btn trashed-back btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Product List
                            </a>&nbsp;&nbsp;&nbsp;

                        </div>
                    </div>
                        <div class="table_option_data">
                            <div class="text-danger">Total Trashed Items ( {{ $totalTrushedProducts }} )</div>
                        </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover data-table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Product Title</th>
                                        <th>Thumbnail</th>
                                        <th>Code</th>
                                        <th>---Category---</th>
                                        <th>-SubCategory-</th>
                                        <th>Selling Price</th>
                                        <th>Discount Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($products as $key => $product)
                                     <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucwords($product->product_title) }}</td>
                                        <td><img src="{{ asset('') }}{{ $product->main_thumbnail }}" class="img-circle" alt="Product Image"
                                            height="50" width="50"></td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>--- {{ ucwords($product->categoy->categoy_name) }} ---</td>
                                        <td>
                                            @if (empty($product->Subcategory->subcategory_name))
                                             Empty
                                            @else
                                            - {{ ucwords($product->Subcategory->subcategory_name)   }} -
                                            @endif
                                        </td>
                                        <td>{{ $product->selling_price }}</td>
                                        <td>{{ $product->discount_price }}</td>
                                        <td>
                                            @if ($product->status == 1)
                                            <span class="badge bg-green">Active</span>   
                                            @else
                                            <span class="badge bg-red">Inactive</span>    
                                            @endif
                                        </td>
                                            <td id="action_content">
                                                <a type="button" title="View" href="{{ route('product.view',$product->id) }}" class="btn-view btn-xs" ><i class="fa fa-eye"></i>
                                                </a>
                                                <a type="button" title="Restore" href="{{ route('product.restore',$product->id) }}" class="btn-restore btn-xs" ><i class="fa fa-undo"></i>

                                                </a>
                                                <form action="{{ route('product.parmanently.delete',$product->id) }}" method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit"
                                                        class="btn-delete btn-xs confirm-button" title="Parmanently Delete"
                                                        style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                               
                                            </td> 
                                     </tr>
                                     @endforeach
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
   
@endsection
