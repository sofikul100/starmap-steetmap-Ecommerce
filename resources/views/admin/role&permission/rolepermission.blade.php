@extends('admin.master')
@section('backend_title')
    Role & Permission
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
            <i class="fa fa-shield"></i>
        </div>
        <div class="header-title">
            <h1> Role & Permission</h1>
            <small> Role & Permission features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Role & Permission</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="row">
                <div class="col-lg-5">
                    <div>
                        <!-- role content -->
                        <div class="" id="roleTable">
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>All Roles</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-sm" onclick="show('roleTable','addRole_form')"
                                            title="Add New" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><i
                                                class="fa fa-plus-circle" aria-hidden="true"></i>
                                            Add New</a>
                                    </div><br /><br />
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($roles as $key => $role)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td class="text-center">{{ ucwords($role->name) }}</td>
                                                    <td class="text-center" id="action_content">
                                                        <a onclick="editRoleContent({{ $role->id }},'roleTable','editRole_form')"
                                                            class="btn btn-warning  btn-xs edit_button" title="Edit"
                                                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                                class="fa fa-pencil"></i> </a>
                                                        <form action="{{ route('delete.role', $role->id) }}" method="POST">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-xs confirm-button" title="Delete"
                                                                style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                                    class="fa fa-trash"></i> </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">
                                                        <p class="text-center no_data"> No Role Found <i
                                                                class="fa fa-exclamation-circle"></i> </p>
                                                    </td>
                                                </tr>
                                            @endforelse


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="" id="addRole_form" style="display: none">
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Add New Role</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form action="{{ route('add.role') }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <label for="name">Role Name : </label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                required placeholder="Role Name">

                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <br />
                                        <div class="input-group" style="margin-top: 15px">
                                            <button type="submit" class="btn btn-primary btn-sm"> <i
                                                    class="fa fa-plus-circle" aria-hidden="true"></i>
                                                Add </button>
                                            <a onclick="show('addRole_form','roleTable')" class="btn btn-black btn-sm"><i
                                                    class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                                Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="" id="editRole_form" style="display: none">
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Edit Role</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form action="{{ route('update.role') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="role_id" id="role_id">
                                        <div class="input-group">
                                            <label for="editrole_name">Role Name : </label>
                                            <input type="text" name="name" id="editrole_name" required
                                                class="form-control" placeholder="Role Name">
                                        </div>
                                        <br />
                                        <div class="input-group" style="margin-top: 15px">
                                            <button type="submit" class="btn btn-primary btn-sm"> <i
                                                    class="fa fa-wrench" aria-hidden="true"></i>
                                                Update </button>
                                            <a onclick="show('editRole_form','roleTable')" class="btn btn-black btn-sm"><i
                                                    class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                                Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!---------end ----------------->
                        <!-- all permission-->
                        <div id="permissionTable">
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>All Permissions</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="pull-right">
                                        <a class="btn btn-primary btn-sm" title="Add New"
                                            onclick="show('permissionTable','addPermission')"
                                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"><i
                                                class="fa fa-plus-circle" aria-hidden="true"></i>
                                            Add New</a>
                                    </div><br /><br />
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-center">Group Name</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($permissions as $key => $permission)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td class="text-center">{{ ucwords($permission->group_name) }}</td>
                                                    <td class="text-center">{{ ucwords($permission->name) }}</td>
                                                    <td class="text-center" id="action_content">
                                                        <a onclick="editPermissionContent({{ $permission->id }},'permissionTable','editPermission')"
                                                            class="btn btn-warning btn-xs edit_button" title="Edit"
                                                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                                class="fa fa-pencil"></i> </a>
                                                        <form action="{{ route('delete.permission', $permission->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit"
                                                                class="btn btn-danger btn-xs confirm-button"
                                                                title="Delete"
                                                                style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"> <i
                                                                    class="fa fa-trash"></i> </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">
                                                        <p class="text-center no_data"> No Permission Found <i
                                                                class="fa fa-exclamation-circle"></i> </p>
                                                    </td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="addPermission" style="display: none">
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Add New Permission</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form action="{{ route('add.permission') }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <label for="group_name">Group Name : </label>
                                            <input type="text" name="group_name" id="group_name" required
                                                class="form-control" placeholder="Group Name">
                                        </div>
                                        @error('group_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <br />
                                        <div class="input-group">
                                            <label for="name">Name : </label>
                                            <input type="text" name="name" id="name" required
                                                class="form-control" placeholder="Permission Name">
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <br />
                                        <div class="input-group" style="margin-top: 15px">
                                            <button type="submit" class="btn btn-primary btn-sm"> <i
                                                    class="fa fa-plus-circle" aria-hidden="true"></i>
                                                Add </button>
                                            <a onclick="show('addPermission','permissionTable')"
                                                class="btn btn-black btn-sm"><i class="fa fa-arrow-circle-left"
                                                    aria-hidden="true"></i>
                                                Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="editPermission" style="display: none">
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Edit Permission</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <form action="{{ route('update.permission') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="permission_id" id="permission_id">
                                        <div class="input-group">
                                            <label for="edit_group_name">Group Name : </label>
                                            <input type="text" name="group_name" required id="edit_group_name"
                                                class="form-control" placeholder="Group Name">
                                        </div>
                                        @error('group_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <br />
                                        <div class="input-group">
                                            <label for="edit_permission_name">Name : </label>
                                            <input type="text" name="name" required id="edit_permission_name"
                                                class="form-control" placeholder="Permission Name">
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <br />
                                        <div class="input-group" style="margin-top: 15px">
                                            <button type="submit" class="btn btn-primary btn-sm"> <i
                                                    class="fa fa-wrench" aria-hidden="true"></i>
                                                Update </button>
                                            <a onclick="show('editPermission','permissionTable')"
                                                class="btn btn-black btn-sm"><i class="fa fa-arrow-circle-left"
                                                    aria-hidden="true"></i>
                                                Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!------------ end -------------->
                    </div>
                </div>
                <div class="col-lg-7">
                    <div>
                        <!-- role and permission-->
                        <div>
                            <div class="panel panel-bd lobidrag panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Role & Permissions</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Permission By GroupName</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($roles as $key => $role)
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td class="text-center">{{ $role->name }}</td>
                                                    <td class="text-center all_permission">

                                                        @forelse ($role->permissions as $permission)
                                                            <strong
                                                                class="custom_badge badge">{{ $permission->name }}</strong>
                                                        @empty
                                                            <p>No Permission Assign Yet!</p>
                                                        @endforelse
                                                    </td>
                                                    <td class="text-center" style="width: 15%">
                                                        <a href="{{ route('assign.permission.form', $role->id) }}"
                                                            class="btn btn-black  btn-sm edit_button"
                                                            title="Assign Permission"
                                                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;margin-bottom:8px"><i
                                                                class="fa fa-plus"></i>
                                                        </a>
                                                        <a href="{{ route('revoke.permissions', $role->id) }}"
                                                            class="btn btn-danger btn-sm delete_button"
                                                            title="Revoke Permission"
                                                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;margin-bottom: 8px;"><i
                                                                class="fa fa-times" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">
                                                        <p class="text-center no_data"> No Role Found <i
                                                                class="fa fa-exclamation-circle"></i> </p>
                                                    </td>
                                                </tr>
                                            @endforelse




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!------------end -------->
                        <!-- assign permissions-->


                        <!----------end-------->
                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </section>

    <script>
        function show(x, y) {
            let xx = document.getElementById(x);
            let yy = document.getElementById(y);

            xx.style.display = 'none';
            yy.style.display = 'block';
        }


        function editRoleContent(id, x, y) {
            show(x, y);

            $.ajax({
                method: 'GET',
                url: '{{ route('edit.role') }}',
                data: {
                    id: id
                },
                success: function(response) {
                    let name = document.getElementById('editrole_name');
                    let role_id = document.getElementById('role_id');
                    name.value = response.name;
                    role_id.value = response.id;

                },
                error: function(error) {
                    console.error(error);
                }
            });
        }



        function editPermissionContent(id, x, y) {
            show(x, y);
            $.ajax({
                method: 'GET',
                url: '{{ route('edit.permission') }}',
                data: {
                    id: id
                },
                success: function(response) {
                    let group_name = document.getElementById('edit_group_name');
                    let permission_name = document.getElementById('edit_permission_name');
                    let permission_id = document.getElementById('permission_id');
                    group_name.value = response.group_name;
                    permission_name.value = response.name;
                    permission_id.value = response.id;

                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
