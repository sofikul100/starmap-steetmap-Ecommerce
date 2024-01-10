@extends('admin.master')
@section('backend_title')
   User-Trashed-List
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
            <i class="fa fa-user text-danger"></i>
        </div>
        <div class="header-title">
            <h1 class="text-danger"> Trashed User</h1>
            <small> Users Trashed Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Trashed User</li>
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
                            <a type="button" href="{{ route('user.index') }}" class="btn trashed-back btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To User List
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
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Avatar</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                    <tr>
                                        <td>
                                            <label>{{ $key + 1 }}</label>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if (empty($user->avatar))
                                            <img src="{{ asset('backend/assets/dist/img/avatar5.png') }}" class="img-circle" alt="{{ Auth::user()->name }}"  height="50" width="50">
                                            @else
                                            <img src="{{ asset('') }}{{ $user->avatar }}" class="img-circle" alt="User Image"
                                            height="50" width="50">
                                            @endif
                                           
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                           @if (empty($user->phone))
                                            No Phone
                                           @else
                                               {{ $user->phone }}
                                           @endif
                                        </td>
                                        <td> 
                                            @foreach ($user->roles as $role)
                                            <span class="badge bg-primary"> {{  $role->name }} </span>
                                            @endforeach
                                             
                                        </td>
                                        <td id="action_content">
                                            <a type="button" href="{{ route('user.view',$user->id) }}" class="btn-view btn-xs" ><i class="fa fa-eye"></i> View
                                            </a>
                                            <a type="button" href="{{ route('user.restore',$user->id) }}" class="btn-restore btn-xs" ><i class="fa fa-undo"></i> Restore
                                            </a>
                                            <form action="{{ route('user.parmanent.delete', $user->id) }}" method="POST">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit"
                                                    class="btn-delete btn-xs confirm-button" title="Parmanent Delete"
                                                    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                        class="fa fa-times"></i> Delete </button>
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
