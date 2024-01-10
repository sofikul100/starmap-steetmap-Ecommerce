@extends('admin.master')
@section('backend_title')
   Coupon-List
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
            <i class="fa fa-ticket"></i>
        </div>
        <div class="header-title">
            <h1> Manage Coupon</h1>
            <small> Coupon Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Coupons</li>
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
                            <a type="button" href="{{ route('coupon.create') }}"
                            class="btn btn-labeled btn-primary m-b-5">
                            <span class="btn-label"><i class="fa fa-plus-circle"></i></span>Add New Coupon
                        </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="table_option_data">
                        <div>Total Coupon ( {{ $totalCoupon }} )</div>
                        <div class="text-black">||</div>
                        <div><a href="{{ route('coupon.trashed.items') }}" class="text-danger">Total Trushed ( {{ $totalTrashed }} )</a></div>
                        <div></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SL NO</th>
                                        <th>Coupon Name</th>
                                        <th>Coupon Code</th>
                                        <th>Start Date</th>
                                        <th>Expire Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $key => $coupon)
                                    <tr>
                                        <td>
                                            <label>{{ $key + 1 }}</label>
                                        </td>
                                        <td>{{ $coupon->coupon_name }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->start_date }}</td>
                                        <td>{{ $coupon-> end_date}}</td>
                                        <td>
                                            @if ($coupon->status ==1)
                                             <span class="badge btn-restore">Active</span>
                                            @else
                                             <span class="badge btn-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td id="action_content">
                                            @if ($coupon->status ==1)
                                            
                                            <a title="Active" href="{{ route('coupon.status',$coupon->id) }}" class="btn-warning btn-xs">
                                                <i id="icon" class="fa fa-toggle-off"></i> Inactive
                                               </a>
                                           @else
                                           <a title="Inactive" href="{{ route('coupon.status',$coupon->id) }}" class="btn-restore btn-xs">
                                            <i id="icon" class="fa fa-toggle-on"></i> Active
                                           </a>
                                           @endif
                                           
                                            <a type="button" href="{{ route('coupon.edit',$coupon->id) }}" class="btn-edit btn-xs" ><i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn-delete btn-xs" title="Delete"
                                                    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                        class="fa fa-trash"></i> Trash</button>
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
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
