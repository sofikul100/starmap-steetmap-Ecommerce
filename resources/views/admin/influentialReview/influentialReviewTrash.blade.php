@extends('admin.master')
@section('backend_title')
    Influential-Review-Trashed-List
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
            <i class="fa fa-star text-danger"></i>
           
        </div>
        <div class="header-title">
            <h1 class="text-danger"> Manage Influential Review Trashed</h1>
            <small> Influential Review Trashed Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Influential Reviews Trashed</li>
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
                            <a type="button" href="{{ route('influentialReview.index') }}"
                            class="btn btn-labeled trashed-back btn-black m-b-5">
                            <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Influential
                            Review List
                        </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="table_option_data">
                        <div>All ( {{ $totalInfluentialReview }} )</div>
                        <div class="text-black">||</div>
                        <div><a href="{{ route('influentialReview.trashed.items') }}" class="text-danger">Trushed ( {{ $totalTrashed }} )</a></div>
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
                                        <th>Influencer Image</th>
                                        <th>Rating</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($influentialReviews as $key => $influentialReview)
                                        <tr>
                                            <td>
                                                <label>{{ $key + 1 }}</label>
                                            </td>

                                            <td>{{ ucwords($influentialReview->name) }}</td>
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
                                            <td id="action_content">
                                                <a title="Active" href="{{ route('influentialReview.show', $influentialReview->id) }}"
                                                    class="btn-view btn-xs">
                                                    <i id="icon" class="fa fa-eye"></i> View
                                                </a>
                                                <a title="Active" href="{{ route('influentialReview.restore', $influentialReview->id) }}"
                                                    class="btn-restore btn-xs">
                                                    <i id="icon" class="fa fa-undo"></i> Restore
                                                </a>
                                                <form action="{{ route('influentialReview.parmanent.delete', $influentialReview->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn-delete btn-xs confirm-button"
                                                        title="Delete" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
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
