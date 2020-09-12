<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Traits\General;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use General;

    public function index(Request $request)
    {
     $posts=Post::where(function ($q) use ($request){
         if($request->input('search')){
             return $q->where('title','like','%'.$request->search.'%');
         }
         if($request->input('category_id')){
             return $q->where('category_id',$request->category_id);
         }
     })->latest()->paginate(3);

     $categories=Category::select('name','id')->get();
     return view('admin.post.index',compact('posts','categories'));
    }


    public function create()
    {
        $categories=Category::select('name','id')->get();
        return view('admin.post.create',compact('categories'));

    }


    public function store(PostRequest $request)
    {
        $path='';
        if($request->has('photo')){
          $path=$this->SaveImages($request->photo,'assets/images/posts');
        }
        $request_data=$request->except(['photo']);
        $request_data['photo']=$path;
        $posts=Post::create($request_data);
        return redirect()->route('post.index')->with(['success'=>'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $posts=Post::where('id',$id)->find($id);
        if(!$posts){
            return  redirect()->route('post.index')->with(['error'=>"هذه المقاله ليست موجوده او ربما قام احد بحذفها"]);
        }
        $categories=Category::select('name','id')->get();
        return view('admin.post.edit',compact('categories','posts'));
    }

    public function update(PostRequest $request, $id)
    {
        $posts=Post::where('id',$id)->find($id);
        if(!$posts){
            return  redirect()->route('post.index')->with(['error'=>"هذه المقاله ليست موجوده او ربما قام احد بحذفها"]);
        }
        $path='';
        if ($request->has('photo')){
            $path=$this->SaveImages($request->photo,'assets/images/posts');
            Post::where('id',$id)->update(['photo'=>$path]);
        }
           Post::where('id',$id)->update([
               'title'=>$request->title,
               'contents'=>$request->contents,
               'category_id'=>$request->category_id
           ]);
        return redirect()->route('post.index')->with(['success'=>'تم الحفظ بنجاح']);
    }

    public function destroy($id)
    {
        $posts=Post::where('id',$id)->find($id);
        if(!$posts){
            return  redirect()->route('post.index')->with(['error'=>"هذه المقاله ليست موجوده او ربما قام احد بحذفها"]);
        }
        $posts->delete();
        return redirect()->route('post.index')->with(['success'=>'تم الحذف بنجاح']);

    }
}
