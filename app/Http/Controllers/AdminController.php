<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }
  
    public function add_new_account_page(){
        return view('admin.add_new_account');
    }
    public function add_new_role_page(){
        return view('admin.add_new_role');
    }
    public function show_role(){
        $showRole = Role::all();
        return view('admin.add_new_account')->with(compact('showRole'));
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.admin_dashboard');
    }
    public function admin_login(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('users')->where('email',$admin_email)
                                    ->where('password',$admin_password)->first();
        if ($result) {
            session::put('admin_name', $result->name);
            session::put('admin_id', $result->id);
            return Redirect('admin/admin-dashboard');
        } else {
            session::put('message', 'Email or password was wrong! Please try again.');
            return Redirect('admin/admin-login');
        }

    }
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect::to('admin/admin-dashboard');
        }else{
            return Redirect::to('admin/admin-login')->send();
        }
    }
    public function admin_logout(){
        $this->AuthLogin();
        session::put('admin_name',null);
        session::put('admin_id',null);
        return Redirect::to('admin/admin-login');
    }
  
    public function insertRole(){
        $data = request()->validate([
            'role_name'=>'required',
            'status_role'=> 'required'
        ]);

        $role = new Role();

        $role->role_name = $data['role_name'];
        $role->status = $data['status_role'];

        $result = $role->save();
        if($result){
            Session::put('message','<span style="color:green">Insert role successfull!</span>');
            return redirect('admin/add-new-role');
        }else{
            Session::put('message','<span style="color:red">Insert role failed!</span>');
            return redirect('admin/add-new-role');
        }
     
    }

    public function createAccount(){
        $data = request()->validate([
            'full_name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
            'role'=>'required'
        ]);

        $user = new User();

        
        if($data['password'] != $data['confirm_password']){
            Session::put('message','<span style="color:red">Password does not match. Please try again! </span>');
            return redirect('admin/add-new-account');
        }else{
            $user->name = $data['full_name'];
            $user->email = $data['email'];
            $user->password = md5($data['password']);
            $user->role_id = $data['role'];
            $user->save();
            Session::put('message','<span style="color:green">Create account successfull!</span>');
            return redirect('admin/add-new-account');
        }      
       
    }
}
