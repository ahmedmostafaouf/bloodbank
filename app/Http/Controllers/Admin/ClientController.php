<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $cities=City::select('id','name','governorate_id')->get();
        $bloodTypes=BloodType::select('id','name')->get();
        $governorates=Governorate::select('id','name')->get();
        $clients=Client::where(function ($qq) use($request){
            if($request->has('city_id')||$request->has('blood_type_id')||$request->has('governorate_id')||$request->has('search')){
                return $qq ->where('city_id',$request->city_id)->orwhere('blood_type_id',$request->blood_type_id)->orwhere('governorate_id',$request->governorate_id)->orwhere('name','like','%'.$request->search.'%');
            }
        })->latest()->paginate(4);
        return view('admin.clients.index',compact('clients','cities','bloodTypes','governorates'));
    }

    public function changeStatus($id){
        $clients=Client::FindOrFail($id);
        if(!$clients){
            return redirect()->route('clients.index')->with(['error' => 'هذا العميل غير موجود ربما قام احد بحذفه']);
        }
        if($clients->status==1){
            $clients->update([
                'status'=>0
            ]);
            return redirect()->route('clients.index')->with(['success'=>'تم الغاء التفعيل الحاله بنجاح']);
        }
        if($clients->status==0){
            $clients->update([
                'status'=>1
            ]);
            return redirect()->route('clients.index')->with(['success'=>'تم تفعيل الحاله بنجاح']);
        }
    }
    public function destroy($id)
    {
      $clients=Client::where('id',$id)->find($id);
      if(!$clients){
          return redirect()->route('clients.index')->with(['error'=>'حدذ حطأ ربما قام أحد بحذف هذا العميل']);
      }
      $clients->delete();
      return redirect()->route('clients.index')->with(['success'=>'تم الحذف بنجاح']);
    }


}
