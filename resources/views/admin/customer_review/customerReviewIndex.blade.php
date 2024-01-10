@extends('admin.master')
@section('backend_title')
    Customer-Review-List
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-star"></i>
        </div>
        <div class="header-title">
            <h1> Manage Customer Review</h1>
            <small> Customer Review Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Customer Reviews</li>
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
                            <h4>Customer Review List</h4>
                        </div>
                    </div>
                    <div class="table_option_data">
                        <div>All ( {{ $totalCustomerReview }} )</div>
                        <div class="text-black">||</div>
                        <div><a href="{{ route('customerReview.trashed.items') }}" class="text-danger">Trushed ( {{ $totalTrashed }} )</a></div>
                        <div class="text-black">||</div>
                        <div><a  class="text-success">Approved ( {{ $totalApproved }} )</a></div>
                        <div class="text-black">||</div>
                        <div><a  class="text-warning">UnApproved ( {{ $totalUnApproved }} )</a></div>
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
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th>Customer Image</th>
                                        <th>Rating</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customerReviews as $key => $customerReview)
                                        <tr>
                                            <td>
                                                <label>{{ $key + 1 }}</label>
                                            </td>

                                            <td>{{ ucwords($customerReview->name) }}</td>
                                            <td>
                                                @if (empty($customerReview->image))
                                                <img src="{{ asset('backend/assets/dist/img/avatar.png') }}"
                                                class="img-circle" alt="Customer Image" height="50" width="50">
                                                @else
                                                <img src="{{ asset('') }}{{ $customerReview->image }}"
                                                class="img-circle" alt="Customer Image" height="50" width="50">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($customerReview->ratings == 1)
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                @elseif ($customerReview->ratings == 2)
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                @elseif ($customerReview->ratings == 3)
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                @elseif ($customerReview->ratings == 4)
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                @elseif ($customerReview->ratings == 5)
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>
                                                <span><i class="fa fa-star" style="color: orange"></i></span>      
                                                @endif
                                            </td>
                                            <td>{{ $customerReview->date }}</td>
                                           
                                            <td>
                                                @if ($customerReview->status == 1)
                                                    <span class="badge bg-active">Approved</span>
                                                @else
                                                    <span class="badge bg-inactive">Not Approved</span>
                                                @endif
                                            </td>
                                            <td id="action_content">
                                                @if ($customerReview->status == 1)
                                                    <a title="Active" href="{{ route('customerReview.status', $customerReview->id) }}"
                                                        class="btn-warning btn-xs">
                                                        <i id="icon" class="fa fa-toggle-off"></i> Not Approved
                                                    </a>
                                                @else
                                                    <a title="Inactive" href="{{ route('customerReview.status', $customerReview->id) }}"
                                                        class="btn-restore btn-xs">
                                                        <i id="icon" class="fa fa-toggle-on"></i> Approved
                                                    </a>
                                                @endif

                                                <a title="Active" href="{{ route('customerReview.view', $customerReview->id) }}"
                                                    class="btn-view btn-xs">
                                                    <i id="icon" class="fa fa-eye"></i> View
                                                </a>
                                                <form action="{{ route('customerReview.destroy', $customerReview->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn-delete btn-xs"
                                                        title="Delete" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                        <i class="fa fa-trash"></i> Trash</button>
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
