@extends('admin.master')
@section('backend_title')
    Influential-Review-View
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-star"></i>
        </div>
        <div class="header-title">
            <h1> View Influential Review</h1>
            <small>View Influential Review Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('influentialReview.index') }}"><i class="pe-7s-home"></i> Influential Review List</a></li>
                <li class="active">Influential Review</li>
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
                            <a type="button" href="{{ route('influentialReview.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Influential Review List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                          
                         <table class="table table-bordered">
                                <thead>
                                     <th>Name</th>
                                     <th>Influencer Image</th>
                                     <th>Rating</th>
                                     <th>Date</th>
                                     <th>Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $influentialReview->name }}</td>
                                        <td>
                                            @if (empty($influentialReview->image))
                                            <img src="{{ asset('backend/assets/dist/img/avatar.png') }}"
                                            class="img-circle" alt="Customer Image" height="50" width="50">
                                            @else
                                            <img src="{{ asset('') }}{{ $influentialReview->image }}"
                                            class="img-circle" alt="Customer Image" height="50" width="50">
                                            @endif
                                        </td>
                                        <td>
                                            @if ($influentialReview->ratings == 1)
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            @elseif ($influentialReview->ratings == 2)
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            @elseif ($influentialReview->ratings == 3)
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            @elseif ($influentialReview->ratings == 4)
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            @elseif ($influentialReview->ratings == 5)
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>
                                            <span><i class="fa fa-star" style="color: orange"></i></span>      
                                            @endif
                                        </td>
                                        <td>{{ $influentialReview->date }}</td>
                                        <td>
                                            @if ($influentialReview->status == 1)
                                                <span class="badge bg-active">Active</span>
                                            @else
                                                <span class="badge bg-inactive">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                                <thead>
                                     <th colspan="4" class="">Review</th>
                                </thead>
                                <tbody>
                                     <tr>
                                        <td colspan="4">{{ $influentialReview->review }}</td>
                                     </tr>
                                </tbody>
                         </table>

                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
@endsection
