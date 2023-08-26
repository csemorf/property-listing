<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function AdminDashboard()
    {
        return view("admin.index");
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin(Request $request)
    {
        return view("admin.admin_login");
    }
    public function AdminProfile(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view("admin.admin_profile_view", compact('profileData'));
    }
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->email = $request->email;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array('message' => 'admin profile update successfully', 'alert-type' => "success");


        return redirect()->back()->with($notification);
    }
    public function AdminChangePassword(Request $request)
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }
    public function AdminUpdatePassword(Request $request)
    {
        $request->validate(['old_password' => 'required', 'new_password' => 'required|confirmed']);

        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array('message' => 'password not matched', 'alert-type' => "error");
            return back()->with($notification);
        }

        $notification = array('message' => 'password update successfully', 'alert-type' => "success");
        User::whereId(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return back()->with($notification);
    }


}