@extends('admin.master')
@section('backend_title')
    Trashed-Customer-Review-List
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-star text-danger"></i>
        </div>
        <div class="header-title">
            <h1 class="text-danger"> Manage Trashed Customer Review</h1>
            <small>Trashed Customer Review Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Trashed Customer Reviews</li>
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
                            <a type="button" href="{{ route('customerReview.index') }}"
                                class="btn btn-labeled trashed-back btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Customer
                                Review List
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
                                                        class="img-circle" alt="Customer Image" height="50"
                                                        width="50">
                                                @else
                                                    <img src="{{ asset('') }}{{ $customerReview->image }}"
                                                        class="img-circle" alt="Customer Image" height="50"
                                                        width="50">
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
                                                <a title="Active"
                                                    href="{{ route('customerReview.view', $customerReview->id) }}"
                                                    class="btn-view btn-xs">
                                                    <i id="icon" class="fa fa-eye"></i> View
                                                </a>
                                                <a title="Active"
                                                    href="{{ route('customerReview.restore', $customerReview->id) }}"
                                                    class="btn-restore btn-xs">
                                                    <i id="icon" class="fa fa-undo"></i> Restore
                                                </a>
                                                <form
                                                    action="{{ route('customerReview.parmanent.delete', $customerReview->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn-delete btn-xs confirm-delete"
                                                        title="Parmanent Delete"
                                                        style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                        <i class="fa fa-times"></i> Delete</button>
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
