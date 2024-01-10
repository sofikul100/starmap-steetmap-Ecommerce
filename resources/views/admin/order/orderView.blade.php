@extends('admin.master')
@section('backend_title')
    View-Order
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
            <i class="fa fa-list-ul"></i>
        </div>
        <div class="header-title">
            <h1> View Order</h1>
            <small>View Order Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('order.index') }}"><i class="pe-7s-home"></i> Order List</a></li>
                <li class="active">View Order</li>
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
                            <a type="button" href="{{ route('order.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Order List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                        <h4>Order..</h4>
                        <table class="table table-bordered">
                            <thead>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                            </thead>

                            <tbody>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_phone }}</td>
                                <td>{{ $order->customer_email }}</td>
                            </tbody>

                            <thead>
                                <th>Customer Country</th>
                                <th>Customer Address</th>
                                <th>Zip Code</th>
                                <th>City</th>
                            </thead>

                            <tbody>
                                <td>{{ $order->customer_country }}</td>
                                <td>{{ $order->customer_address }}</td>
                                <td>{{ $order->customer_zipcode }}</td>
                                <td>{{ $order->customer_city }}</td>
                            </tbody>


                            <thead>
                                <th>Extra Phone</th>
                                <th>Total </th>
                                <th>Sub-Total</th>
                                <th>Payment Type</th>
                            </thead>

                            <tbody>
                                <td>
                                    @if (empty($order->customer_extra_phone))
                                        <span class="text-danger">Null</span>
                                    @else
                                        {{ $order->customer_extra_phone }}
                                    @endif
                                </td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->subtotal }}</td>
                                <td>{{ $order->payment_type }}</td>
                            </tbody>

                            <thead>
                                <th>Coupon Code</th>
                                <th>Coupon Discount</th>
                                <th>After Discount</th>
                                <th>Shipping Charj</th>
                            </thead>

                            <tbody>
                                <td>
                                    @if (empty($order->coupon_code))
                                        <span class="text-danger">Null</span>
                                    @else
                                        {{ $order->cooupon_code }}
                                    @endif
                                </td>
                                <td>
                                    @if (empty($order->coupon_discount))
                                        <span class="text-danger">Null</span>
                                    @else
                                        {{ $order->coupon_discount }}
                                    @endif
                                </td>
                                <td>
                                    @if (empty($order->after_discount))
                                        <span class="text-danger">Null</span>
                                    @else
                                        {{ $order->after_discount }}
                                    @endif
                                </td>
                                <td>
                                    {{ $order->shipping_charge }}
                                </td>
                            </tbody>

                            <thead>
                                <th>Date</th>
                                <th>Order Status</th>
                            </thead>

                            <tbody>
                                <td>{{ $order->date }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge bg-primary">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                            Order Processing
                                        </span>
                                    @elseif ($order->status == 1)
                                        <span class="badge bg-purple">
                                            <i class="fa fa-truck" aria-hidden="true"></i>
                                            Order Shipped
                                        </span>
                                    @elseif ($order->status == 2)
                                        <span class="badge bg-green">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            Order Completed
                                        </span>
                                    @elseif ($order->status == 3)
                                        <span class="badge bg-orange">
                                            <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                                            Order Return
                                        </span>
                                    @elseif ($order->status == 4)
                                        <span class="badge bg-cancel">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            Order Cancel
                                        </span>
                                    @endif
                                </td>
                            </tbody>

                        </table>

                        <h4>Order Details Here..</h4>

                        <table class="table table-bordered">
                             <thead class="bg-info">
                                 <th>Product Name</th>
                                 <th>Quantity</th>
                                 <th>Price</th>
                                 <th>Total Price</th>
                             </thead>
                             <tbody>
                                @forelse ($order->order_details as $product_d)
                                    <tr>
                                        <td>{{ $product_d->product_name }}</td>
                                        <td>{{ $product_d->quantity }} Pcs</td>
                                        <td>{{ $product_d->single_price }}</td>
                                        <td>{{ $product_d->quantity * $product_d->single_price }}</td>
                                    </tr>
                                @empty
                                    <td>No Data Found!</td>
                                @endforelse
                                <tr></tr>
                             </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
@endsection
