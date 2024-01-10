@extends('admin.master')
@section('backend_title')
   Coupon-Trashed-List
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
            <i class="fa fa-ticket text-danger"></i>
        </div>
        <div class="header-title">
            <h1 class="text-danger"> Trashed Coupon</h1>
            <small> Coupon Trashed Items Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Trashed Coupons</li>
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
                            <a type="button" href="{{ route('coupon.index') }}" class="btn trashed-back btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Coupon List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
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
                                        <td id="action_content">
                                            <a type="button" href="{{ route('coupon.restore',$coupon->id) }}" title="Restore" class="btn-restore btn-xs" ><i class="fa fa-undo"></i> Restore
                                            </a>
                                            <form action="{{ route('coupon.parmanent.delete', $coupon->id) }}" method="POST">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn-delete btn-xs confirm-button" title="Parmanent Delete"
                                                    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                        class="fa fa-times"></i> Delete</button>
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
