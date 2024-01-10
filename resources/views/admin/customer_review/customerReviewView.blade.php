@extends('admin.master')
@section('backend_title')
    Customer-Review-View
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-star"></i>
        </div>
        <div class="header-title">
            <h1> View Customer Review</h1>
            <small>View Customer Review Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('customerReview.index') }}"><i class="pe-7s-home"></i> Customer Review List</a></li>
                <li class="active">Customer Review</li>
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
                            <a type="button" href="{{ route('customerReview.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Customer Review List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                          
                         <table class="table table-bordered">
                                <thead>
                                     <th>Name</th>
                                     <th>Customer Image</th>
                                     <th>Rating</th>
                                     <th>Date</th>
                                     <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $customerReview->name }}</td>
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
                                    </tr>
                                </tbody>
                                <thead>
                                     <th colspan="4" class="">Review</th>
                                </thead>
                                <tbody>
                                     <tr>
                                        <td colspan="4">{{ $customerReview->review }}</td>
                                     </tr>
                                </tbody>
                         </table>

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

    <script>
        $(document).ready(function() {
            $(".err").delay(5000).slideUp(300);
        });
    </script>
@endsection
