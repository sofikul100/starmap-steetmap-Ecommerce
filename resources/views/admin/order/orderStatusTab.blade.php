@extends('admin.master')
@section('backend_title')
    Order-List
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list-ul"></i>
        </div>
        <div class="header-title">
            <h1> Manage Order</h1>
            <small> Orders Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Orders</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd" id="tab_panel">
                    <div class="panel-heading" id="tab_panel_heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#draft" class="draft_button" data-toggle="tab"> <i class="fa fa-pencil-square-o"
                                        aria-hidden="true"></i> Draft【 】 </a></li>
                            <li><a href="#pending" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                    Pending 【 50 】</a></li>
                            <li><a href="#incomming" data-toggle="tab"><i class="fa fa-arrow-circle-down"
                                        aria-hidden="true"></i> Incoming 【 20 】</a></li>
                            <li><a href="#production" data-toggle="tab"><i class="fa fa-industry" aria-hidden="true"></i> In
                                    Production 【 150 】</a></li>
                            <li><a href="#ready" data-toggle="tab"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                    Ready 【 170 】</a></li>
                            <li><a href="#pickedup" data-toggle="tab"> <i class="fa fa-hand-paper-o" aria-hidden="true"></i>
                                    Picked Up 【 40 】</a></li>
                            <li><a href="#delivered" data-toggle="tab"><i class="fa fa-check" aria-hidden="true"></i>
                                    Delivered 【
                                    1500 】</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nav tabs -->
        <!-- Tab panels -->
        <div class="tab-content">
            {{-- draft --}}
            <div class="tab-pane fade in active" id="draft">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Draft Order List</h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table"
                                                id="draft-orders-table" style="width: 100% !important">
                                                <thead>
                                                    <tr>
                                                        <th id="select_all_content" style="width:4% !important">
                                                            <input type="checkbox" class="row-checkbox" id="select_all">
                                                        </th>
                                                        <th>Sl</th>
                                                        <th>Order ID</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
                                        <script>
                                            $(document).ready(function() {
                                                $('#draft-orders-table').DataTable({
                                                    serverSide: true,
                                                    "ajax": {
                                                        "url": "{{ route('order.status.list.tab') }}",
                                                        "data": function(e) {
                                                            e.status = 1;
                                                            e.search = $('input[type="search"]').val();
                                                        },

                                                    },
                                                    columns: [{
                                                            data: 'custom_checkbox',
                                                            name: '',
                                                        },

                                                        {
                                                            data: 'DT_RowIndex',
                                                            name: 'DT_RowIndex',
                                                            orderable: false,
                                                            searchable: false,
                                                            className: 'text-center',
                                                            width: '5%'
                                                        },

                                                        {
                                                            data: 'order_id',
                                                            name: 'order_id',
                                                        },
                                                        {
                                                            data: 'customer_name',
                                                            name: 'name'
                                                        },
                                                        {
                                                            data: 'created_at',
                                                            name: 'date'
                                                        },
                                                        {
                                                            data: 'total',
                                                            name: 'total',
                                                            orderable: true
                                                        },
                                                        {
                                                            data: 'subtotal',
                                                            name: 'subtotal'
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
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            {{-- pending --}}
            <div class="tab-pane fade" id="pending">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-clock-o" aria-hidden="true"></i> Pending Order List</h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table" style="width: 100%" id="pending-orders-table">
                                                <thead>
                                                    <tr>
                                                        <th id="select_all_content" style="width:4% !important">
                                                            <input type="checkbox" class="row-checkbox" id="select_all">
                                                        </th>
                                                        <th>Sl</th>
                                                        <th>Order ID</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>


                                        <script>
                                            $(document).ready(function() {
                                                $('#pending-orders-table').DataTable().destroy();
                                                $('#pending-orders-table').DataTable({
                                                    serverSide: true,
                                                    "ajax": {
                                                        "url": "{{ route('order.status.list.tab') }}",
                                                        "data": function(e) {
                                                            e.status = 2;
                                                            e.search = $('input[type="search"]').val();
                                                        },

                                                    },
                                                    columns: [{
                                                            data: 'custom_checkbox',
                                                            name: '',
                                                        },

                                                        {
                                                            data: 'DT_RowIndex',
                                                            name: 'DT_RowIndex',
                                                            orderable: false,
                                                            searchable: false,
                                                            className: 'text-center',
                                                            width: '5%'
                                                        },

                                                        {
                                                            data: 'order_id',
                                                            name: 'order_id',
                                                        },
                                                        {
                                                            data: 'customer_name',
                                                            name: 'name'
                                                        },
                                                        {
                                                            data: 'created_at',
                                                            name: 'date'
                                                        },
                                                        {
                                                            data: 'total',
                                                            name: 'total',
                                                            orderable: true
                                                        },
                                                        {
                                                            data: 'subtotal',
                                                            name: 'subtotal'
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



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- incomming --}}
            <div class="tab-pane fade" id="incomming">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Incomming Order List
                                    </h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table" id="datatable4">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>C Name</th>
                                                        <th>C Phone</th>
                                                        <th>C Email</th>
                                                        <th>C Address</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Payment Type</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- production --}}
            <div class="tab-pane fade" id="production">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-industry" aria-hidden="true"></i> Production Order List</h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table" id="datatable5">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>C Name</th>
                                                        <th>C Phone</th>
                                                        <th>C Email</th>
                                                        <th>C Address</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Payment Type</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- ready --}}
            <div class="tab-pane fade" id="ready">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-check-circle" aria-hidden="true"></i> Ready Order List</h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table" id="datatable6">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>C Name</th>
                                                        <th>C Phone</th>
                                                        <th>C Email</th>
                                                        <th>C Address</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Payment Type</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- pickedup --}}
            <div class="tab-pane fade" id="pickedup">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-hand-paper-o" aria-hidden="true"></i> Pickedup Order List</h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table" id="datatable7">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>C Name</th>
                                                        <th>C Phone</th>
                                                        <th>C Email</th>
                                                        <th>C Address</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Payment Type</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- delivered --}}
            <div class="tab-pane fade" id="delivered">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag panel-primary">
                            <div class="panel-heading">
                                <div class="btn-group">
                                    <h4><i class="fa fa-area-chart"></i> Delivered Order List</h4>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="card">
                                    <div class="card-body" id="tab_col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover data-table" id="datatable8">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>C Name</th>
                                                        <th>C Phone</th>
                                                        <th>C Email</th>
                                                        <th>C Address</th>
                                                        <th>Total</th>
                                                        <th>SubTotal</th>
                                                        <th>Payment Type</th>
                                                        <th>Order Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>









        </div>
    </section> <!-- /.content -->
@endsection
