<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index(Request $request)
    {
      $cities= City::where(function ($q) use ($request) {
          if($request->input('search')){
              return $q ->where('name','like','%'.$request->search.'%');
          }
          if($request->input('governorate_id')){
              return $q ->where('governorate_id',$request->governorate_id);
          }
      })->latest()->paginate("3");
      $governorates=Governorate::select('name','id')->get();
      return view('admin.city.index',compact('cities','governorates'));
    }

    public function create()
    {
        $governorates=Governorate::select('name','id')->get();
      return view('admin.city.create',compact('governorates'));
    }




    public function store(CityRequest $request)
    {
          $cities=City::create($request->all());
          return redirect()->route('cities.index')->with(['success'=>"تم الاضافه بنجاح"]);
    }


    public function edit($id)
    {
        $governorates=Governorate::select('name','id')->get();
        $cities=City::select('name','id')->find($id);
        if (!$cities){
            return  redirect()->route('cities.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
          return view('admin.city.edit',compact('cities','governorates'));
    }

    public function update(CityRequest $request, $id)
    {
        $cities=City::select('name','id')->find($id);
        if (!$cities){
            return  redirect()->route('cities.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        $cities->update($request->all());
        return redirect()->route('cities.index')->with(['success'=>"تم النعديل بنجاح"]);
    }


    public function destroy($id)
    {
        $cities=City::where('id',$id)->find($id);
        if(!$cities){
            return  redirect()->route('cities.index')->with(['error'=>"هذه المحافظه لا يمكن حذفها لانها تقوم بحذف اشياء اخري"]);
        }
         $clients=$cities->clients();
        //بجيب التجار الي موجوده في القسم وبقوله لو فيه تجار ف القسم لايمكن حذفه
        if(isset($clients)&&$clients->count() >0) {
            return redirect()->route("cities.index")->with(['error' => 'لا يمكن حذف هذا القسم لان عند حذفه سيتم حذف اشياء اخري']);
        }

        $cities->delete();
        return redirect()->route('cities.index')->with(['success'=>'تم الحذف بنجاح']);
    }
}
