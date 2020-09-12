<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodTypeRequest;
use App\Models\BloodType;
use Illuminate\Http\Request;

class BloodTypeController extends Controller
{

    public function index(Request $request)
    {
       $bloodTypes=BloodType::where(function ($q) use($request){
           if($request->input('search')){
               return $q ->where('name','like','%'.$request->search.'%');
           }
    })->latest()->paginate("3");
        return view('admin.blood_type.index',compact('bloodTypes'));
    }


    public function create()
    {
      return view('admin.blood_type.create');
    }


    public function store(BloodTypeRequest $request)
    {
        $bloodTypes=BloodType::create($request->all());
        return redirect()->route('blood-types.index')->with(['success'=>'تم الاضافه بنجاح']);
    }




    public function edit($id)
    {
       $bloodTypes=BloodType::select('name','id')->find($id);
       if(!$bloodTypes){
           return  redirect()->route('blood-types.index')->with(['error'=>"هذه الفصيلة ليست موجوده او ربما قام احد بحذفها"]);
       }
       return view('admin.blood_type.edit',compact('bloodTypes'));
    }


    public function update(BloodTypeRequest $request, $id)
    {
        $bloodTypes=BloodType::select('name','id')->find($id);
        if(!$bloodTypes){
            return  redirect()->route('blood-types.index')->with(['error'=>"هذه الفصيلة ليست موجوده او ربما قام احد بحذفها"]);
        }
        $bloodTypes->update($request->all());
        return redirect()->route('blood-types.index')->with(['success'=>'تم التعديل بنجاح']);
    }


    public function destroy($id)
    {

        $bloodTypes=BloodType::where('id',$id)->find($id);
        if(!$bloodTypes){
            return  redirect()->route('blood-types.index')->with(['error'=>"هذه المحافظه لا يمكن حذفها لانها تقوم بحذف اشياء اخري"]);
        }
        $clients=$bloodTypes->clients();
        if(isset($clients)&&$clients->count() >0) {
            return redirect()->route("blood-types.index")->with(['error' => 'للا يمكن حذف هذا القسم لان عند حذفه سيتم حذف اشياء اخري']);
        }
        $bloodTypes->delete();
        return redirect()->route('blood-types.index')->with(['success'=>'تم الحذف بنجاح']);

    }
}
