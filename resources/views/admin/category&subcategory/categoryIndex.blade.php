@extends('admin.master')
@section('backend_title')
    Category-List
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
            <i class="fa fa-folder"></i>
        </div>
        <div class="header-title">
            <h1> Manage Category</h1>
            <small> Category Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Categories</li>
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
                            <a type="button" href="{{ route('category.add') }}" class="btn btn-labeled btn-primary m-b-5">
                                <span class="btn-label"><i class="fa fa-plus-circle"></i></span>Add Category
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
                                        <th>Serial No</th>
                                        <th>Category Image</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $categorie)
                                        <tr>
                                            <td>
                                                <label>{{ $key + 1 }}</label>
                                            </td>
                                            <td><img src="{{ asset('') }}{{ $categorie->category_image }}"
                                                    class="img-circle" alt="User Image" height="50" width="50"></td>
                                            <td>{{ ucwords($categorie->categoy_name) }}</td>
                                            <td>
                                                @if ($categorie->status == 1)
                                                    <span class="badge btn-restore">Active</span>
                                                @else
                                                    <span class="badge btn-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td id="action_content">
                                                @if ($categorie->status == 1)
                                                    <a title="Active" href="{{ route('category.status', $categorie->id) }}"
                                                        class="btn-warning btn-xs">
                                                        <i id="icon" class="fa fa-toggle-off"></i> Inactive
                                                    </a>
                                                @else
                                                    <a title="Inactive" href="{{ route('category.status', $categorie->id) }}"
                                                        class="btn-restore btn-xs">
                                                        <i id="icon" class="fa fa-toggle-on"></i> Active
                                                    </a>
                                                @endif

                                                <a type="button" href="{{ route('category.edit', $categorie->id) }}"
                                                    class="btn-edit btn-xs"><i class="fa fa-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('category.delete', $categorie->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn-delete btn-xs confirm-button"
                                                        title="Delete" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                        <i class="fa fa-trash"></i> Delete</button>
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
