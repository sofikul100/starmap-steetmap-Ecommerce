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
                <div class="panel panel-bd lobidrag panel-primary">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <h4 style="font-weight: bold"><i class="fa fa-list-ul"></i> All Order List</h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <p class="bulk_filter_title"> <i class="fa fa-square"></i>
                            Bulk Action || <i class="fa fa-filter"></i>
                            Filter Order.</p>
                        <div class="row" id="filter_row">
                           
                            <form action="" id="bulk_form">
                                @csrf
                                <div class="col-md-3" style="display: flex;align-items:center;gap:6px;margin-bottom:10px">

                                    <select required name="bluk_action" id="bluk_action" class="form-control">
                                        <option selected disabled> Bulk Action </option>
                                        <option value="trash">Move To Trash</option>
                                        <option value="4">Change Status To Production</option>
                                        <option value="5">Change Status To Ready</option>
                                        <option value="6">Change Status To Picked Up</option>
                                        <option value="7">Change Status To Delivered</option>
                                    </select>

                                    <button class="btn btn-primary"> <i class="fa fa-check-circle"></i>
                                        Apply</button>

                                </div>
                            </form>
                            <form action="" id="date_status_filter_form">
                                <div class="col-md-3" style="margin-bottom:10px">
                                    <select name="date_filter" id="date_filter" class="form-control">
                                        <option value="" selected>All Dates</option>
                                        <option value="today">Today Orders</option>
                                        <option value="yesterday">Yesterday Orders</option>
                                        <option value="last_week">Last Week Orders</option>
                                        <option value="this_week">This Week Orders</option>
                                        <option value="last_month">Last Month Orders</option>
                                        <option value="this_month">This Month Orders</option>
                                        <option value="last_year">Last Year Orders</option>
                                        <option value="this_year">This Year Orders</option>
                                    </select>
                                </div>

                                <div class="col-md-3" style="margin-bottom:10px">
                                    <select name="status_filter" id="status_filter" class="form-control">
                                        <option value="" selected>All Order Status</option>
                                        <option value="0">Processing</option>
                                        <option value="1">Draft</option>
                                        <option value="2">Pending</option>
                                        <option value="3">Incomming</option>
                                        <option value="4">In Production</option>
                                        <option value="5">Ready</option>
                                        <option value="6">PickedUp</option>
                                        <option value="7">Delivered</option>
                                    </select>
                                </div>

                                <div class="col-md-3" style="margin-bottom:10px">
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option value="" selected>All Payment</option>
                                        <option value="hand_cash">Hand Case</option>
                                        <option value="paypal">Paypal</option>
                                        <option value="card">Credit Card</option>
                                    </select>
                                </div>

                                <div id="reset_content">
                                    <button type="reset" id="reset" class="btn btn-info"> <i
                                            class="fa fa-refresh"></i> Double Click To Reset</button>
                                </div>



                            </form>
                        </div>









                        <div class="card">
                            <div class="card-body" id="tab_col" style="position: relative">


                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover data-table" style="width: 100%"
                                        id="all_order" style="position:relative">
                                        <thead>
                                            {{-- <input type="checkbox" class="row-checkbox" id="select_all"> --}}
                                            <tr>
                                                <th id="select_all_content" width="5%">
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
                                    </table>
                                </div>



                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/dist/js/order.js') }}"></script>
    <script>
        //======= when page loading by default it will render===========//
        $(function all_order() {
            all_orders_table = $("#all_order").DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                "ajax": {
                    "url": "{{ route('order.index') }}",
                    "data": function(e) {
                        e.date_filter = $("#date_filter").val();
                        e.status_filter = $("#status_filter").val();
                        e.payment_type = $("#payment_type").val();
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
@endsection
