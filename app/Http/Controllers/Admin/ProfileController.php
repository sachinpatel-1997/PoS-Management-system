<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
class ProfileController extends Controller
{
      public function view(){
          $id = Auth::guard('admin')->user()->id;
        // $id = Auth::admin()->id;
        $user = Admin::find($id);
        return view('admin.user.view-profile', compact('user'));
    }

    public function edit(){
        $id = Auth::admin('venue')->id;
        $editData = Admin::find($id);
        return view('admin.user.edit-profile', compact('editData'));
    }

    public function update(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = Auth::admin('venue')->id;
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $filename);
            $data['image'] = $filename;
        }
        $data->save();
        return redirect()->route('profiles.view')->with('success', 'Profile info updated!');
    }

    public function passwordView() {
        return view('admin.user.edit-password');
    }


    public function passwordUpdate(Request $request) {
        if(Auth::attempt(['id' => Auth::admin('venue')->id, 'password' => $request->current_password])){
            $user = Admin::find(Auth::admin('venue')->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('profiles.view')->with('success', 'Password changed successful!');
        } else {
            return redirect()->back()->with('error', 'Sorry! Your current password does not match!');
        }
    }
}
