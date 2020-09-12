<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $contacts=Contact::paginate(10);
        return view('admin.contacts.index',compact('contacts'));
    }

    public function destroy($id)
    {
      $contacts=Contact::where('id',$id)->find($id);
      if(!$contacts){
          return  redirect()->route('reports.index')->with(['error'=>"هذا التقرير ليست موجوده او ربما قام احد بحذفها"]);
      }
      $contacts->delete();
      return redirect()->route('reports.index')->with(['success'=>'تم الحذف بنجاح ']);
    }
}
