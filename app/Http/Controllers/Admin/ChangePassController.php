<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
 public function change(){
     return view('admin.changePassword.edit');
 }
  public function updateChange(Request $request){
      if(!(Hash::check($request->get('oldPassword'),auth()->user()->password))){
          return redirect()->route('admin.change')->with(['error'=>'كلمه السر القديمه حطأ']);
      }
      if(strcmp($request->get('oldPassword'),$request->get('newPassword'))==0){
          return redirect()->route('admin.change')->with(['error'=>'لايجوز ان تكون كلمه السر الجديد تساوي كلمه السر القديمه']);
      }
      $validatedData = $request->validate([
          'oldPassword' => 'required',
          'newPassword' => 'required|string|min:6|confirmed',
      ]);
      $user=auth()->user();
      $request_data=$request->except(['password']);
      $request_data['password']=bcrypt($request->newPassword);
      $user->update($request_data);
      return redirect()->route('admin.change')->with(['success'=>'تم التحديث بنجاح']);

  }

}
