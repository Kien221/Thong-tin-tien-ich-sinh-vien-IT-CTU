<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthController extends Controller
{
    public function showLoginForm()
    {   
        $builder = new CaptchaBuilder;
        $builder->build();
        $phrase =  $builder->getPhrase();
        session(['phrase'=>$phrase]);
        return view('admin.auth.login',[
            'captcha'=>$builder->inline()
        ]);
    }
    public function login(Request $request){
        $admin = Admin::query()
                ->where('Admin_pw',$request->get('Ma_So'))
                ->where('password',$request->get('password'))
                ->first();
        if($admin){
            $captcha = $request -> get('captcha');
            if($captcha == session('phrase')){
               session()->put('admin_id',$admin->id);
               session()->put('admin_pw',$admin->Admin_pw);
               session()->put('admin_name',$admin->fullname);
            //    $user = array([
            //     'admin_id' => $admin->id,
            //     'admin_pw' => $admin->Admin_pw,
            //     'admin_name' => $admin->fullname,
            //     ]);
            //     session()->put('user',$user);
               return redirect()->route('admin.category');
            }
            else{
                return redirect()->back()->with('error_captcha','Mã xác nhận không đúng');  
            } 
        }
        else return redirect()->back()->with('error_pw_password','Mã số hoặc mật khẩu không đúng');
    }
    public function logout(){
        session()->flush();
        return redirect()->route('admin.login');
    }
}
