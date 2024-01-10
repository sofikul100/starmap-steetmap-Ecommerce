@extends('admin.master')
@section('backend_title')
    Order-Trashed-List
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-trash text-danger"></i>
        </div>
        <div class="header-title">
            <h1 class="text-danger"> Manage Order Trashed</h1>
            <small> Orders Trashed Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Order Trashed List</li>
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
                            <h4 style="font-weight: bold"><i class="fa fa-list-ul"></i> All Trashed Order List</h4>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="row" id="filter_row">
                            <form action="" id="bulk_form_trash">
                                @csrf
                                <div class="col-md-4" style="display: flex;align-items:center;gap:6px;margin-bottom:10px">

                                    <select required name="bluk_action" id="bluk_action" class="form-control">
                                        <option selected disabled> Bulk Action </option>
                                        <option value="delete">Parmanent Delete</option>
                                        <option value="restore">Order Restore</option>
                                    </select>

                                    <button class="btn btn-primary"> <i class="fa fa-check-circle"></i>
                                        Apply</button>

                                </div>
                            </form>
                            <form action="" id="date_status_filter_form_trashed">
                                <div class="col-md-4" style="margin-bottom:10px">
                                    <select name="date_filter_trashed" id="date_filter_trashed" class="form-control">
                                        <option value="" selected>All Dates</option>
                                        <option value="today">Today Trashed</option>
                                        <option value="yesterday">Yesterday Trashed</option>
                                        <option value="last_week">Last Week Trashed</option>
                                        <option value="this_week">This Week Trashed</option>
                                        <option value="last_month">Last Month Trashed</option>
                                        <option value="this_month">This Month Trashed</option>
                                        <option value="last_year">Last Year Trashed</option>
                                        <option value="this_year">This Year Trashed</option>
                                    </select>
                                </div>

                                <div class="col-md-4">

                                    <div>
                                        <button type="reset" id="reset" class="btn btn-info"> <i
                                                class="fa fa-refresh"></i> Double Click To Reset</button>
                                    </div>
                                </div>






                            </form>
                        </div>









                        <div class="card">
                            <div class="card-body" id="tab_col" style="position: relative">


                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover data-table" id="order_trashed_table"
                                        style="position:relative">
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
                                        <tbody id="table_wrapper_content">
                                            @foreach ($all_orders as $key => $order)
                                                <tr>
                                                    <td><input type="checkbox" name="sub_checkbox"
                                                            value="{{ $order->id }}" id="sub_checkbox"
                                                            class="form-checkbox" data-id="{{ $order->id }}">
                                                    </td>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>{{ $order->customer_name }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($order->date)) }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->subtotal }}</td>
                                                    <td>
                                                        @if ($order->status == 0)
                                                            <span class="status_processing"> <i class="fa fa-refresh"></i>
                                                                Processing</span>
                                                        @elseif($order->status == 1)
                                                            <span class="status_draft"> <i
                                                                    class="fa fa-pencil-square-o"></i> Draft</span>
                                                        @elseif($order->status == 2)
                                                            <span class="status_pending"> <i class="fa fa-clock-o"></i>
                                                                Pending</span>
                                                        @elseif($order->status == 3)
                                                            <span class="status_incomming"> <i
                                                                    class="fa fa-arrow-circle-down"></i>
                                                                Incomming</span>
                                                        @elseif($order->status == 4)
                                                            <span class="status_production"> <i class="fa fa-industry"></i>
                                                                In
                                                                Production</span>
                                                        @elseif($order->status == 5)
                                                            <span class="status_ready"> <i class="fa fa-check-circle-o"></i>
                                                                Ready</span>
                                                        @elseif($order->status == 6)
                                                            <span class="status_pickedup"> <i
                                                                    class="fa fa-hand-paper-o"></i> Picked
                                                                Up</span>
                                                        @elseif($order->status == 7)
                                                            <span class="status_delivered"> <i class="fa fa-check"
                                                                    aria-hidden="true"></i>
                                                                Delivered</span>
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <a href="{{ route('order.show', $order->id) }}" title="View"
                                                            class="btn btn-view btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ route('order.restore', $order->id) }}" title="Restore"
                                                            class="btn btn-restore btn-sm"><i class="fa fa-undo"></i></a>
                                                        <a href="" title="Parmanent Delete"
                                                            class="btn btn-delete btn-sm confirm-button"><i
                                                                class="fa fa-times"></i></a>
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

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/dist/js/orderTrashed.js') }}"></script>
    <script>
        let status = 0;
        $(function all_order() {
            orders_trashed_table = $("#order_trashed_table").DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                "ajax": {
                    "url": "{{ route('order.show.trashed.items') }}",
                    "data": function(e) {
                        e.date_filter_trashed = $("#date_filter_trashed").val();
                    }
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
