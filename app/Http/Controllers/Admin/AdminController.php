<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use App\Admin;
use Image;
class AdminController extends Controller
{
    public function dashboard(){  
        return view('admin.admin_dashboard');
    }

    
     public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessage = [
                'email.required' => 'Email Address is required',
                'email.email' => 'Valid Email is required',
                'password.required' =>'Password is required',
            ];

            $this->validate($request,$rules,$customMessage);
             //$validatedData = $request->validate([
        //'email' => 'required|email|max:255',
        //'password' => 'required',
    //]);
    
            // echo $password = Hash::make('12345678'); die;
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }
           // echo "<pre>"; print_r($data); die;
        }
       return view('admin.admin_login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(\URL::previous());
        // return redirect('/admin');
    }
    public function view(){
        $data['allData'] = Admin::all();
        return view('admin.user.view-user', $data);
    }

    public function add(){
        return view('admin.user.add-user');
    }

    public function store(Request $request){
        $request->validate([
            'usertype' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $data = new Admin();
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('users.view')->with('success', 'User created successful!');

    }

    public function edit($id){
        $editData = Admin::find($id);
        return view('admin.user.edit-user', compact('editData'));
    }

    public function update($id,Request $request){
        $data = Admin::find($id);
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();
        return redirect()->route('users.view')->with('success', 'User info updated!');
    }

    public function delete($id){
        $data = Admin::find($id);
        if(file_exists('public/upload/user_images'.$data->image) AND !empty($data->image)){
            unlink('public/upload/user_images'.$data->image);
        }
        $data->delete();
        return redirect()->route('users.view')->with('success', 'User Deleted!');
    }
    
}
