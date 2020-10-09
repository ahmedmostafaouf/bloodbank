<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\RegisterRequest;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function getClientRegister(){
        $governorates=Governorate::all();
        $cities=City::all();
        $bloodTypes=BloodType::all();
        return view('front.auth.register',compact('governorates','cities','bloodTypes'));
    }
    public function register(RegisterRequest $request)
    {
        $request_data=$request->except(['password']);
        $request_data['password']=Hash::make($request->get('password'));
        $clients=Client::create($request_data);
        $blood_type=BloodType::where('id',$request->blood_type_id)->first();
        $clients->bloodTypes()->sync($blood_type);
        $cities=City::where('id',$request->city_id)->first();
        $clients->cities()->sync($cities);
        $governorates=City::where('id',$request->governorate_id)->first();
        $clients->governorates()->sync($governorates);
        return redirect()->route('get.front.login')->with(['success'=>"تم الاضافه بنجاح قم بتسجيل الدخول"]);
    }
}
