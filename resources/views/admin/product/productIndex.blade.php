@extends('admin.master')
@section('backend_title')
    Product-List
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
            <i class="fa fa-cube" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1> Manage Product</h1>
            <small> Product Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Products</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            {{-- <div class="col-sm-12">
                <div class="panel panel-bd lobidrag panel-primary">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <h4>Filter Products</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="title" placeholder="Product Title.." class="form-control">
                            </div>
                            <div class="col-md-4">
                                <select name="category" id="category" class="form-control">
                                    <option value="">...........</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="subcategory" id="subcategory" class="form-control">
                                    <option value="">...........</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-labeled btn-primary m-b-5">
                                    <span class="btn-label"><i class="fa fa-filter"></i></span>Filter Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag panel-primary">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <a type="button" href="{{ route('product.create') }}"
                                class="btn btn-labeled btn-primary m-b-5">
                                <span class="btn-label"><i class="fa fa-plus-circle"></i></span>Add Product
                            </a>&nbsp;&nbsp;&nbsp;

                        </div>
                    </div>
                        <div class="table_option_data">
                            <div>Total ( {{ $totalProducts }} )</div>
                            <div class="text-black">||</div>
                            <div><a href="{{ route('product.trashed.items') }}" class="text-danger">Trushed ( {{ $totalTrushedProducts }} )</a></div>
                            <div></div>
                        </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover data-table" id="product_table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Product Title</th>
                                        <th>Thumbnail</th>
                                        <th>Code</th>
                                        <th>---Category---</th>
                                        <th>-SubCategory-</th>
                                        <th>Price</th>
                                        <th>Discount Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
        $(function product() {
            table = $(".data-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product_title',
                        name: 'product_title'
                    },
                    {
                        data: 'main_thumbnail',
                        name: 'thumbnail'
                    },
                    {
                        data: 'product_code',
                        name: 'Code'
                    },
                    {
                        data: 'categoy_name',
                        name: 'category'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory'
                    },
                    {
                        data: 'selling_price',
                        name: 'price'
                    },
                    {
                        data: 'discount_price',
                        name: 'Discount_price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]
            });
        });
    </script>

   <script>
         $('body').on('click',"#status",() =>{
                var status = $("#status").prop('checked') == true ? 1 : 0;
                var product_id =  $("#status").data('product_id');  
                

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route("product.status") }}',
                    data: {'status': status, 'product_id': product_id},
                    success: function(response){
                        if(response.success == true){
                             toastr.success('Product Status Updated');
                             $('.data-table').DataTable().ajax.reload();
                        }
                    },
                    error:function(error){
                        console.log(error)
                    }
                });
                
         });
   </script>

   <script>
        $('body').on('click','#TempdeleteButton',() =>{
            var product_id =  $("#status").data('product_id'); 

            var token = '{{ csrf_token() }}';

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    type: "DELETE",
                    dataType: "json",
                    url: 'product/'+product_id,
                    data: {'product_id': product_id},
                    success: function(response){
                        if(response.success == true){
                             toastr.success('Product Trashed Successfully');
                             $('.data-table').DataTable().ajax.reload();
                        }
                    },
                    error:function(error){
                        console.log(error)
                    }
                });

        })
   </script>




@endsection
