<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {

            $location_name = 'images/user_images/'; //change folder name according to the MODEL

            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = env('PUBLIC_FILE_LOCATION') ? public_path('../' . $location_name) : public_path($location_name);
            $file->move($destinationPath, $name);
            $location = $location_name . $name;

            if ($user->avatar) {

                if (file_exists(public_path($user->avatar))) {
                    unlink(public_path($user->avatar));
                }

                $user->avatar = $location;
            } else {
                $user->avatar = $location;
            }
        }

        $user->save();
        return redirect()->back()->with('message', 'Your Profile Updated Done');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



    public function changePassword()
    {

        return view('admin.changePassword.changePassword');
    }


    public function checkCurrentPassword(Request $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json(['message' => 'Current Password Is Currect', 'success' => true]);
        } else {
            return response()->json(['message' => 'Current Password Is InCurrect', 'success' => false]);
        }
    }



    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password'
        ]);

        if (Hash::check($request->current_password, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update(['password' => bcrypt($request->new_password)]);
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('message', 'Password Change Successfully. Please Login');
        } else {
            return redirect()->back()->with('message', 'Current Password does not Match');
        }
    }





    //===========user methods will be here============//
    public function userIndex()
    {
        $users = User::get();
        $totalUser = User::withTrashed()->count();
        $totalTrashed  = User::onlyTrashed()->get()->count();
        return view('admin.users.userIndex', compact('users', 'totalUser', 'totalTrashed'));
    }



    public function userAdd()
    {
        $roles = DB::table('roles')->get();
        return view('admin.users.userAdd', compact('roles'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->role) {
            $user->assignRole($request->role);
        }

        return redirect()->back()->with('message', 'User Added Successfully');
    }


    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $roles = DB::table('roles')->get();
        return view('admin.users.userEdit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->detach();
        if ($request->role) {
            $user->assignRole($request->role);
        }

        return redirect()->back()->with('message', 'User Update Successfully');
    }


    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'User Trashed Successfully');
    }




    public function userTrashedItems()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.userTrashedItems', compact('users'));
    }



    public function userView($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $permissions = DB::table('permissions')->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
            ->where('model_has_roles.model_id', $user->id)
            ->select('permissions.*')
            ->get();
        return view('admin.users.userView', compact('user', 'permissions'));
    }



    public function userRestore($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->restore();
        return redirect()->back()->with('message', 'User Restore Successfully');
    }

    public function userParmanentDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->forceDelete();
        return redirect()->back()->with('message', 'User Parmanently Deleted Successfully');
    }

















    // $user = User::find(1);

    // $permissions = DB::table('permissions')->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
    // ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
    // ->where('model_has_roles.model_id', $user->id)
    // ->select('permissions.*')
    // ->get();

    // dd($permissions);


}
