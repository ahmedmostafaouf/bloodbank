<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GovernorateRequest;
use App\Models\Category;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{

    public function index(Request  $request)
    {
        $governorates=Governorate::when($request ->search,function ($q) use ($request){
            return $q ->where('name','like','%'.$request ->search.'%');
        })->latest()->paginate("2");
        return view('admin.governorate.index',compact('governorates'));
    }


    public function create()
    {
        return view('admin.governorate.create');
    }


    public function store(GovernorateRequest $request)
    {
       $governorate=Governorate::create($request->all());
       return redirect()->route('governorates.index')->with(['success'=>'تم الاضافه بنجاح']);
    }




    public function edit($id)
    {
        $governorates=Governorate::select('name','id')->find($id);
        if(!$governorates){
            return  redirect()->route('governorates.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        return view('admin.governorate.edit',compact('governorates'));
    }

    public function update(GovernorateRequest $request, $id)
    {
       $governorates=Governorate::select('name','id')->find($id);
        if(!$governorates){
            return  redirect()->route('governorates.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        $governorates->update($request->all());
        return  redirect()->route('governorates.index')->with(['success'=>"تم التعديل بنجاح"]);
    }


    public function destroy($id)
    {

      $governorates=Governorate::where('id',$id)->find($id);
      if(!$governorates){
          return  redirect()->route('governorates.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
      }
        $city = $governorates->cities();
        //بجيب المدن الي موجوده في المحافظه وبقوله لو فيه مدن ف المحافظه لايمكن حذفه
        if(isset($city)&&$city->count() >0) {
            return redirect()->route("governorates.index")->with(['error' => 'للا يمكن حذف هذا القسم لان عند حذفه سيتم حذف اشياء اخري']);
        }

            $governorates->delete();
        return redirect()->route('governorates.index')->with(['success'=>'تم الحذف بنجاح']);
    }
}
