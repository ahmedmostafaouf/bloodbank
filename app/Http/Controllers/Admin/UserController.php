<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function _construct(){
        $this->middleware(['admin','permission:read_users'])->only('index');
        $this->middleware(['admin','permission:create_users'])->only('create');
        $this->middleware(['admin','permission:update_users'])->only('edit');
        $this->middleware(['admin','permission:delete_users'])->only('delete');
    }

    public function index(Request $request)
    {
        $users=User::whereRoleIs('admin')->when($request->search,function ($q) use($request){
            return $q->where('first_name','like','%'.$request -> search.'%')->orwhere('last_name','like','%'.$request -> search.'%');
        })->latest()->paginate(5);
      return view('admin.users.index',compact('users'));
    }

    public function create()
    {
      return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $request_data=$request->except(['password']);
        $request_data['password']=bcrypt($request->password);
        $user=User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permission); // بديلو الاسم الي ف الشيك
        return redirect()->route('users.index')->with(['success'=>'تم الاضافه بنجااااح']);
    }

    public function edit($id)
    {
        $users = User::select('id','first_name','last_name','email')->find($id);
        if(!$users){
            return redirect()->route('users.index')->with(['error'=>'حدث خطأ ما او ربما قام احد بحذف هذا المستخدم']);
        }
        return view('admin.users.edit',compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' =>'required|max:20',
            'last_name' =>'required|max:20',
            'email' =>'required|email|unique:users,email,'.$request->idd,
            'permission' =>'required|min:1',
        ]);

        $users = User::select('id','first_name','last_name','email')->find($id);
        if(!$users){
            return redirect()->route('users.index')->with(['error'=>'حدث خطأ ما او ربما قام احد بحذف هذا المستخدم']);
        }
        $request_data=$request->except(['permission']);
        $users->update($request_data);
        $users->syncPermissions($request->permission);
       return redirect()->route('users.index')->with(['success'=>'تم التعديل بنجااااح']);

    }

    public function destroy($id)
    {
        $users = User::where('id',$id)->find($id);
        if(!$users){
            return redirect()->route('users.index')->with(['error'=>'حدث خطأ ما او ربما قام احد بحذف هذا المستخدم']);
        }
        $users->delete();
        return redirect()->route('users.index')->with(['success'=>'تم الحذف بنجااااح']);
    }
}
