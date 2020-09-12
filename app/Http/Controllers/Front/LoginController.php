<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getClientLogin(){
       return view('front.auth.login');
    }
    public function Login(LoginRequest $request){
         if(auth()->guard('web')->attempt(['phone'=>$request->input('phone'),'password'=>$request->input('password')],$request->filled('remember'))){
         return redirect()->route('client-home');
         }
        return redirect()->back()->with(['error' => 'حدث خطأ بالبيانات']);

    }
}
