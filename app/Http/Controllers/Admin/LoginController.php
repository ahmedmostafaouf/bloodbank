<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class LoginController extends Controller
{

    public function getLogin(){
        return view('admin.auth.login');
    }
    public function login(LoginRequest $request){
        $remember_me=$request->has('remember_me') ? true : false;
        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])) {
            //notify()->success('تم الدخول بنجاح');
            return redirect()->route('admin.dashboard');
        }
        // notify()->error('حدث خطأ فى البيانات الرجاء المحاوله مجددا');
        return redirect()->back()->with(['error' => 'حدث خطأ بالبيانات']);

    }




}
