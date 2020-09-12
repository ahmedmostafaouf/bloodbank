<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function index(Request $request)
    {
        $cities=City::all();
        $bloodTypes=BloodType::all();
        $clients=Client::select('name','id')->get();
        $donations=DonationRequest::where(function ($qq) use($request){
             if($request->has('city_id')||$request->has('blood_type_id')||$request->has('from') &&$request->has('to')){
                 return $qq ->where('city_id',$request->city_id)->orwhere('blood_type_id',$request->blood_type_id);
             }
        })->latest()->paginate(4);
        return view('admin.donation.index',compact('donations','cities','clients','bloodTypes'));


}


     public function show($id)
    {
        $donations=DonationRequest::where('id',$id)->find($id);
        if(!$donations){
            return  redirect()->route('post.index')->with(['error'=>"هذ الطلب ليست موجود او ربما قام احد بحذفها"]);
        }
        return view('admin.donation.show',compact('donations'));
    }



    public function destroy($id)
    {
        $donations=DonationRequest::where('id',$id)->find($id);
        if(!$donations){
            return  redirect()->route('post.index')->with(['error'=>"هذ الطلب ليست موجود او ربما قام احد بحذفها"]);
        }
         if($donations ->client()->count()||$donations->bloodType()->count()||$donations->city()->count()){
             return  redirect()->route('donation.index')->with(['error'=>"لايمكن حذفه"]);
         }
        $donations->delete();
        return redirect()->route('donation.index')->with(['success'=>'تم الحذف بنجاح']);

    }
}
