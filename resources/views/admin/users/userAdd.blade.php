@extends('admin.master')
@section('backend_title')
    User-Add
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
            <h1> Add New User</h1>
            <small>Add User Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('user.index') }}"><i class="pe-7s-home"></i> User List</a></li>
                <li class="active">Add User</li>
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
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" required class="form-control"
                                            placeholder="Enter  Name">
                                        @error('name')
                                            <p class="text-danger err">{{ $message }}</p>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-6">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" required class="form-control"
                                            placeholder="Enter Email">
                                        @error('email')
                                            <p class="text-danger err">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="spacer"></div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="text" name="password" id="password" required class="form-control" placeholder="Enter Password">
                                        @error('password')
                                            <p class="text-danger err">hello{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="role">Assign Role<span class="text-danger">*</span></label>
                                       <select name="role" id="role" class="form-control">
                                          <option value="" selected disabled>Select Role</option>

                                          @forelse ($roles as $role)
                                          <option value="{{ $role->name }}">{{ $role->name }}</option>
                                          @empty
                                              <option value="" disabled selected>No Role Found!</option>
                                          @endforelse
                                       </select>
                                       
                                    </div>
                                </div>

                               

                               <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-labeled btn-success m-b-5 update_button">
                                            <span class="btn-label"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </span>Add Now
                                        </button>
                                    </div>
                                </div>
                               </div>
                            </form>

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
