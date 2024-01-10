@extends('admin.master')
@section('backend_title')
   Assign Permission
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
            <small> Assign Permission features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Assign Permission</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div  id="assign_permission" style="display: block">
                    <div class="panel panel-bd lobidrag panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="page_title">Assign Permission</h4>
                                <span class="back_button">
                                    <a href="{{ route('rolePermission') }}" class="btn btn-sm btn-black"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                         Back To Role & Permission</a>
                                </span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="role_name">
                                <h4>Role Name: <span class="text-primary role_name_text"> {{ $role->name }}</span></h4>
                                    <div class="input-group">
                                        <span><input type="checkbox" class="form-control permission_checkbox" name="select_all" id="select_all" {{ App\Models\User::roleHasPermission($role,$all_permissions) ? 'checked' : '' }}></span>
                                        <span><label for="select_all" class="select-all-text">Select All</label></span>
                                    </div>
                            </div>

                            <form action="{{ route('assign.permission.store',$role->id) }}" method="POST">
                                @csrf
                                <div class="permission_content row">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @forelse ($permission_groups as $permission_group)
                                            @php
                                            $permissions = App\Models\User::getPermissionByGroupName($permission_group->group_name);
                                            $j=1;
                                            @endphp 
                                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 permission_column role-{{ $i }}-management-checkbox">
                                            <div class="group_name">
                                                <input type="checkbox" class="permission_checkbox"
                                                 {{ App\Models\User::roleHasPermission($role,$permissions) ? 'checked' : '' }}
                                                 onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox',this)"
                                                 name="group_name" id="{{ $i }}Management"> <label for="{{ $i }}Management" class="group_label">{{ $permission_group->group_name }}</label>
                                            <hr/>
                                            </div>
                                            
                                            @forelse ($permissions as $permission)
                                            <div class="permission_input_content custom-control custom-checkbox">
                                                <input type="checkbox" name="permissions[]"
                                                 value="{{ $permission->id }}"
                                                 onclick="checkSinglePermission('role-{{ $i }}-management-checkbox','{{ $i }}Management',{{ count($permissions) }})" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                 class="form-checkbox permission_checkbox custom-control-input"
                                                    id="checkPermission{{ $permission->id }}">
                                                <label for="checkPermission{{ $permission->id }}" class="permission_label">{{ ucwords($permission->name) }}</label>
                                            </div>
                                            @php
                                                $j++;
                                            @endphp
                                            @empty
                                                <p>No Permission Found!</p>
                                              
                                            @endforelse
                                            
                                        </div>
                                        @php
                                           $i++;
                                        @endphp
                                        @empty
                                            <p>No Group Name Found!</p>
                                           
                                        @endforelse
                                       
                                </div>

                                <div>
                                    <input type="submit" class="btn bg-info btn-sm save_changes"
                                        value="Save Changes" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                </div>
                            </form>
                        </div>
                    </div>
        </div>
            </div>
        </div> <!-- /.row -->
    </section>
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script>
        $("#select_all").click(function (){
            if($(this).is(':checked')){
             $('input[type=checkbox]').prop('checked',true)
          }else{
             $('input[type=checkbox]').prop('checked',false)
          }
        });


        function checkPermissionByGroup (className,checkThis){
            const groupName = $("#"+checkThis.id);
            const classCheckBox = $("."+className+' input');
            
            if(groupName.is(':checked')){
                classCheckBox.prop('checked',true)
            }else{
                classCheckBox.prop('checked',false)
            }

            implementAllChecked();
        }




        function checkSinglePermission (groupClassName,groupID,countTotalPermission){
             const classCheckBox = $('.',+groupClassName+ ' input');
             const groupIDCheckbox = $("#"+groupID);
             if($('.'+groupClassName+' input:checked').length == countTotalPermission){
                 groupIDCheckbox.prop('checked',true)
             }else{
                groupIDCheckbox.prop('checked',false)
             }

             implementAllChecked();
        }



        function implementAllChecked (){
            const countPermissions = {{ count($all_permissions) }};
            const countPermissionGroups  = {{ count($permission_groups) }};

            if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                $("#select_all").prop('checked',true)
            }else{
                $("#select_all").prop('checked',false)
            }
        }







    </script>
@endsection
