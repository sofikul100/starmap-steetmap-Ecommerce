<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index () {
        $roles = Role::all();
        $permissions = Permission::orderBy('group_name')->get();
        $permission_groups = User::getPermissionGroups();
        return view('admin.role&permission.rolepermission',compact('roles','permissions','permission_groups'));
    }


    public function addRole (Request $request){
        $request->validate([
            'name'=>'required'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect()->back()->with('message','Role Added Successfully');
    }


    public function editRole (Request $request){
        $role = Role::findOrFail($request->id);
        return response()->json($role);
    }


    public function updateRole (Request $request){
        $request->validate([
            'name'=>'required'
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->name = $request->name;
        $role->save();
        return redirect()->back()->with('message','Role Updated Successfully');
    }




    public function deleteRole (string $id){
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('message','Role Deleted Successfully');
    }



    //----------permission related methods---------//
    public function addPermission (Request $request){
          $request->validate([
             'group_name'=>'required',
             'name'=>'required'
          ]);


        $permission = new Permission();
        $permission->group_name = $request->group_name;
        $permission->name = $request->name;
        $permission->save();
        return redirect()->back()->with('message','Permission Added Successfully');
    }


    public function editPermission (Request $request){
        $permission = Permission::findOrFail($request->id);
        return response()->json($permission);
    }


    public function updatePermission (Request $request){
        $request->validate([
             'group_name'=>'required',
             'name'=>'required'
        ]);

        $permission = Permission::findOrFail($request->permission_id);
        $permission->group_name = $request->group_name;
        $permission->name = $request->name;
        $permission->save();
        return redirect()->back()->with('message','Permission Updated Successfully');
    }




    public function deletePermission (string $id){
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('message','Permission Deleted Successfully');
    }




    public function assignPermissionForm (Request $request){
        $roles = Role::all();
        $all_permissions = Permission::get();
        $permission_groups = User::getPermissionGroups();
        $role = Role::findOrFail($request->role_id);
         return view('admin.role&permission.assign-permission',compact('roles','all_permissions','permission_groups','role'));
    }


    public function assignUpdatePermission (Request $request,$id){
        
        $role = Role::FindOrFail($id);
        $role->syncPermissions([]);
       
        $data = array();
        $permissions = $request->permissions;
 
        foreach($permissions as $key => $permission){
            $data['role_id'] = $id;
            $data['permission_id'] = $permission;
 
            DB::table('role_has_permissions')->insert($data);
        }
        
        return redirect()->back()->with('message','Permission Assign Successfully');


    }


    public function revokePermission (string $id){
        $role = Role::findOrFail($id);
        $role->syncPermissions([]);

        return redirect()->route('rolePermission')->with('message','Permission Revoke Successfully');
    }


}
