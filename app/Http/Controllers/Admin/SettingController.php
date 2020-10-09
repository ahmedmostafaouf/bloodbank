<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $settings=Setting::paginate(10);
        return view('admin.setting.index',compact('settings'));
    }

    public function edit($id)
    {
         $settings=Setting::select('id','about_app','long_desc','small_desc','phone','email','fb_url','tw_url','insta_url','youtube_url')->find($id);
        if(!$settings){
            return  redirect()->route('setting.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        return view('admin.setting.edit',compact('settings'));
    }


    public function update(SettingRequest $request, $id)
    {
        $settings=Setting::select('id','about_app','long_desc','small_desc','phone','email','fb_url','tw_url','insta_url','youtube_url')->find($id);
        if(!$settings){
            return  redirect()->route('setting.index')->with(['error'=>"هذه المحافظه ليست موجوده او ربما قام احد بحذفها"]);
        }
        $settings->update($request->all());
        return  redirect()->route('setting.index')->with(['success'=>"تم التعديل بنجاح"]);
    }

}
