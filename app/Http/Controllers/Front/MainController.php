<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Http\Requests\Front\RegisterRequest;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use App\Traits\General;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
    use General;
    public function home(){
        $posts=Post::take(10)->get();
        $donations=DonationRequest::take(10)->get();
        return view('front.home',compact('posts','donations'));
    }
    public function about(){
        return view('front.about');
    }
    public function posts(){
        $posts=Post::all();
        return view('front.posts',compact('posts'));
    }
    public function postDetails($id){
        $posts=Post::findOrFail($id);
        return view('front.postsDetails',compact('posts'));
    }
    public function toggleFavourite(Request $request)
    {
        $toggle = $request->user()->favorites()->toggle($request->post_id);
        return $this->responsesData(1, 'success', $toggle);
    }
    public function getContact()
    {
        return view('front.contact');
    }
    public function contact(ContactRequest $request)
    {
       $contact=Contact::create($request->all());
       return redirect()->route('contact.me')->with(['success'=>'تم ارسال الابلاغ بنجاح']);
    }
    public function getPostFavorites(Request $request)
    {
         $postsFav=$request->user()->favorites()->latest()->paginate(20);
        return view('front.posts_fav',compact('postsFav'));
    }
    public function getProfile()
    {
        $bloodTypes=BloodType::select('name','id')->get();
        $cities=City::select('name','id')->get();
        $governorates=Governorate::select('name','id')->get();
        return view('front.profile',compact('bloodTypes','governorates','cities'));
    }
    public function editProfile(Request $request)
    {
        //validation
        $rules=[
            'phone' => Rule::unique('clients','phone')->ignore($request->user()->id),
            'email' => Rule::unique('clients','email')->ignore($request->user()->id),
        ];
        //$validator=validator($request->all(),$rules);
        $request->validate($rules);
          $client=$request->user();
          $client->update($request->all());
          if($request->has('governorate_id')){
              $client->update(['governorate_id'=>$request->governorate_id]);
              $client->governorates()->syncWithoutDetaching($request->governorate_id);
          }
        if ($request->has('blood_type_id')) {
            $client->update(['blood_type_id' => $request->blood_type_id]);
            $client->bloodTypes()->syncWithoutDetaching($request->blood_type_id);
        }if ($request->has('city_id')) {
            $client->update(['city_id' => $request->city_id]);
            $client->cities()->syncWithoutDetaching($request->city_id);
        }
        return redirect()->route('get.client.profile')->with(['success'=>'تم التعديل بنجاح']);
    }
    public function donation(Request $request){
        $bloodTypes=BloodType::select('name','id')->get();
        $cities=City::select('name','id')->get();

        $donations=DonationRequest::where(function ($q) use($request){
            if($request->has('blood_type')||$request->has('city')){
                return $q->where('blood_type_id',$request->blood_type)->orwhere('city_id',$request->city);
            }
        })->latest()->paginate('6');
        return view('front.donation',compact('bloodTypes','cities','donations'));
    }
}
