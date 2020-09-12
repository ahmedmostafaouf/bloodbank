<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories=Category::when($request->search ,function ($q) use($request){
            return $q->where('name','like','%'.$request ->search.'%');
        })->latest()->paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
       return view('admin.categories.create');
    }


    public function store(CategoryRequest $request)
    {
        $categories=Category::create($request->all());
        return redirect()->route('category.index')->with(['success'=>'تم الاضافه بنجاح']);
    }


    public function edit($id)
    {
        $categories=Category::select('name','id')->find($id);
        if(!$categories){
            return  redirect()->route('category.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        return view('admin.categories.edit',compact('categories'));

    }


    public function update(Request $request, $id)
    {
        $categories=Category::select('name','id')->find($id);
        if(!$categories){
            return  redirect()->route('category.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        $categories->update($request->all());
        return  redirect()->route('category.index')->with(['success'=>"تم التعديل بنجاح"]);

    }



    public function destroy($id)
    {
        $categories=Category::where('id',$id)->find($id);
        if(!$categories){
            return  redirect()->route('category.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
       $posts= $categories->posts();
        if($posts &&$posts->count()>0){
            return redirect()->route("category.index")->with(['error' => 'للا يمكن حذف هذا القسم لان عند حذفه سيتم حذف اشياء اخري']);
        }
        $categories->delete();
        return  redirect()->route('category.index')->with(['success'=>"تم الحذف بنجاح"]);
    }
}
