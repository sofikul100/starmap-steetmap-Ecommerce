@extends('admin.master')
@section('backend_title')
    User-View
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
            <i class="fa fa-user"></i>
        </div>
        <div class="header-title">
            <h1> View User</h1>
            <small>View User Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('user.index') }}"><i class="pe-7s-home"></i> User List</a></li>
                <li class="active">View User</li>
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
                            <a type="button" href="{{ route('user.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To User List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                          
                         <table class="table table-bordered">
                                <thead>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>Phone</th>
                                     <th>Role Name</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        @foreach ($user->roles as $role)
                                            <td><span class="badge bg-primary">{{ ucwords($role->name) }}</span></td>
                                        @endforeach
                                    </tr>
                                </tbody>
                                <thead>
                                     <th colspan="4" class="">Permissions</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="permission_td">
                                            @forelse ($permissions as $permission)
                                              <span class="badge bg-green" style="margin-bottom:10px">{{ $permission->name }}</span>
                                            @empty
                                                <span class="text-danger">No Permissions! <a href="{{ route('rolePermission') }}">Assign Permission In This Role</a></span>
                                            @endforelse
                                            
                                        </td>
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
