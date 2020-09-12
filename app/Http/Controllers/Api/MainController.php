<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use App\Traits\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MainController extends Controller
{
    use General;

    public function getCities(Request $request)
    {

        $cities = City::where(function ($q) use ($request) {
            if ($request->has('governorate_id')) {
                $q->where('governorate_id', $request->governorate_id);
            }
        })->get();
        return $this->responsesData('success', 'cities', $cities, 'تم الرجوع');

    } // end of func get cities

    public function getGovernorate()
    {
        $Governorates = Governorate::all();
        return $this->responsesData('success', 'Governorate', $Governorates, 'success');
    }

    public function profile(Request $request)
    {
        $validator = validator($request->all(), [
            'password' => 'confirmed',
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
            'email' => Rule::unique('clients')->ignore($request->user()->id),
        ]);
        if ($validator->fails()) {
            return $this->responsesData('0', 'error', $validator->errors());
        }
        $loginClient = $request->user(); // object data of user
        $loginClient->update($request->all());
        if ($request->has('password')) {
            $loginClient->password = Hash::make(request()->get('password'));
        }
        $loginClient->save();
        // why ? because when update the many to many table (clients-governorate)is updated so notification setting is updated
        if ($request->has('governorate')) {
            $loginClient->update(['governorate_id' => $request->governorate]);
            $loginClient->governorates()->syncWithoutDetaching($request->governorate);
        }
        if ($request->has('blood_type_id')) {
            $bloodTypes = BloodType::where('id', $request->blood_type_id)->first();
            $loginClient->update(['blood_type_id' => $request->blood_type_id]);
            $loginClient->bloodTypes()->syncWithoutDetaching($bloodTypes);
        }
        $loginClient->save();
        return $this->responsesData('1', 'Client', $loginClient, 'تم النعديل بنجاح');

    }  // end of func get profile

    public function notificationSetting(Request $request)
    {
        $notSettingText = Setting::select('notification_setting_text')->first();
        //check blood type found in data base or  no
        if ($request->has('blood_type')) {
            $BloodTypeID = BloodType::where('id', $request->blood_type)->first();
            if (!$BloodTypeID) {
                return $this->responsesData('false', 'BloodType', $BloodTypeID, 'not found');
            }
        }
        $blood_type = $request->user()->bloodTypes()->get();
        $request->user()->bloodTypes()->sync($request->blood_type);
        // governorate
        if ($request->has('governorate')) {
            $GovernorateID = Governorate::where('id', $request->governorate)->first();
            if (!$GovernorateID) {
                return $this->responsesData('false', 'Governorate', $BloodTypeID, 'not found');
            }
        }
        $request->user()->governorates()->sync($request->governorate);
        $governorates = $request->user()->governorates()->get();
        return $this->responsesData('success', 'NotifySetting', [$notSettingText, $blood_type, $governorates]);
    } //end of notify setting

    public function posts(Request $request)
    {
        $posts = Post::all();
        if ($request->has('category')) {
            $posts = Post::where('category_id', $request->category)->get();
        }
        if ($request->has('search')) {
            $posts = Post::when($request->search, function ($q) use ($request) {
                return $q->where('title', 'like', '%' . $request->search . '%');
            })->latest()->paginate(5);
        }
        return $this->responsesData('1', 'post', $posts, 'success');
    }  // end of func get governorates

    public function PostFavorites(Request $request)
    {
        $validator = validator($request->all(), [
            'post_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responsesData('0', 'error', $validator->errors());
        }
        $postID = Post::select('id')->find($request->post_id);
        if (!$postID) {
            return $this->responsesData('false', 'postFavorites', $postID, 'not found');
        }
        $toggle = $request->user()->favorites()->syncWithoutDetaching($request->post_id);
        return $this->responsesData('success', 'toggle', $toggle, 'تم الرجوع بنجاح');
    } //end of post favorites

    public function myFavorites(Request $request)
    {
        $favorites = $request->user()->favorites()->latest()->paginate(20);
        return $this->responsesData('success', 'favorites', $favorites, 'هئا البوستات المفضله لهذا الشخص');
    } //end of myFavorites

    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(20);
        return $this->responsesData('success', 'notifications', $notifications, 'هئا قائمه الاشعارات لهذا الشخص');
    } // end of notifications

    public function contacts(Request $request)
    {
        $validator = validator($request->all(), [
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:200',
        ]);
        if ($validator->fails()) {
            return $this->responsesData('false', 'contacts', $validator->errors());
        }
        $contacts = Contact::create($request->all());

        return $this->responsesData('success', 'contacts', $contacts, 'هئا قائمه الكونتاكت لهذا الشخص');
    }// end of contacts

    public function donation_request(Request $request)
    {

        $validator = validator($request->all(), [
            'patient_name' => 'required|string|max:50',
            'age' => 'required',
            'bags_num' => 'required|digits:1',
            'hospital_address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'blood_type_id' => 'required',
            'patient_phone' => 'required|digits:11',
            'details' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responsesData('false', 'DonationRequest', $validator->errors());
        }
        $donationReq = $request->user('clients-api')->donationRequestes()->create($request->all());
        // all clients in governorate = governorate->donation and then send notify for all//
        $clientsId = $donationReq->city->governorate->clients()->whereHas('bloodTypes', function ($q) use ($request) {
            $q->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();

        if (count($clientsId)) {
            // create notify
            $notifications = $donationReq->notification()->create([
                'title' => 'يوجد حاله قريبه منك',
                'content' => $donationReq->bloodtype->name . 'نريد متبرع فصيله : ',
            ]);
            $notifications->clients()->attach($clientsId); // many to many between notification and client

            // FCM firebase
            $tokens = Token::whereIn('client_id', $clientsId)->where('tokenFireBase', '!=', null)->pluck('tokenFireBase')->toArray();
            if (count($tokens)) {
                $title = $notifications->title;
                $body = $notifications->content;
                $data = [
                    'donation_request_id' => $donationReq->id,
                ];
                $send = $this->notifyByFirebase($title, $body, $tokens, $data);
                info('fire base result :' . $send);

            }

        }
        return $this->response('status', 'تم الاضافه بنجاح', compact('donationReq'));

    }

    public function test_notification(Request $request)
    {
        $tokens = $request->tokenFireBase;
        $title = $request->title;
        $body = $request->body;
    $data = DonationRequest::first();
      $send = $this->notifyByFirebase($title, $body, $tokens, $data, true);
          info("firebase result: " . $send);
        return response()->json([
            'status' => 1,
            'msg' => 'تم الارسال بنجاح',
            'send' => json_decode($send)
        ]);
    }


}
