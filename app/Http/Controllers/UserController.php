<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index()
    {
        return view('frontend.index');
    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit_profile', compact('userData'));
    }
    public function UserProfileStore(Request $request)
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
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array('message' => 'user update successfully', 'alert-type' => "success");


        return redirect()->back()->with($notification);
    }
    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function UserChangePassword(Request $request)
    {
        return view('frontend.dashboard.change_password');
    }

    public function UserPasswordUpdate(Request $request)
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