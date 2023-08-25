<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        return redirect()->back();
    }
}