<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\BloodType;
use App\Models\Client;
use App\Models\Token;
use App\Traits\General;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{

    use General;

    public function register(Request $request){
        try {
            $validator=validator($request->all(),[
                'name'=>'required',
                'phone'=>'required|unique:clients,phone',
                'email'=>'required|unique:clients,email|email',
                'password'=>'required|confirmed',
                'governorate_id'=>'required|exists:governorates,id',
                'city_id'=>'required|exists:cities,id',
                'dop'=>'required',
                'last_donation_date'=>'required',
                'blood_type_id'=>'required'
            ]);
            if($validator ->fails()){
                return $this->responsesData('0','validation error',$validator->errors()->first(),'error');
            }

            $request_data=request()->except(['password']);
            $request_data['password']=Hash::make(request()->get('password'));
            $clients=Client::create($request_data);
            $blood_type=BloodType::where('id',$request->blood_type_id)->first();
            $clients->bloodTypes()->sync($blood_type);
            $clients->cities()->sync($request->city_id);
            $clients->governorates()->sync($request->governorate_id);
            return $this->responsesData('1','client',$clients,'تم الاضافه بنجاح');

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function login(Request $request){
        $validator=validator($request->all(),[
            'phone'=>'required',
            'password'=>'required'
        ]);
        if ($validator ->fails()){
            return $this->responsesData('0','validator error',$validator->errors(),'errors');
        }
        $credentials = $request->only(['phone','password']);

        $token = auth('clients-api')->attempt($credentials);
        if(!$token) {
            return $this->returnError('E003', 'بيانات الدخول غير صحيحة');
        }
        // return data and token
        $client= auth('clients-api')->user();
       $client-> api_token =$token;
        return $this -> responsesData('1' ,'client', $client);
    }
    public function rest_password(Request $request)
    {
        $validator=validator($request->all(),[
            'phone'=>'required',
        ]);
        if($validator->fails()){
            return $this->responsesData('0','validator error',$validator->errors(),'errors');
        }
        $client=Client::where('phone',$request->phone)->first();
        if($client){
            $code=rand('11111','88888');
            $update_code=$client->update(['pin_code'=>$code]);
            if($update_code){
                //send email message use mail trap or gmail
                Mail::to($client->email)
                    ->bcc('a7med.mostafa9900@gmail.com')
                    ->send(new ResetPassword($code));

                //send sms in mobile phone
                return $this->responsesData('success','pin_code_to_reset_password_is : ',$code,'انتظر رساله علي الفون بالكود');
            }else{
                return $this->returnError('E0003','حدث خطأ ما ولم يتم ارسال الكود ');
            }
        }else{
            return $this->returnError('E0003','لم يتم تسجيل ايميل بهذا الهاتف من قبل');
        }
    }
    public function forget_password(Request $request)
    {
        $validator = validator($request->all(), [
            'pin_code'=>'required',
            'password'=>'required|confirmed'
        ]);
        if ($validator->fails()) {
            return $this->responsesData('0', 'validator error', $validator->errors(), 'errors');
        }
        $client=Client::where('pin_code',$request ->pin_code)->where('pin_code','!=',0)->first();
        if($client){
            $client_new_pass=$client->update(['password'=>Hash::make(request()->get('password')),'pin_code'=>null]);
            return $this->responsesData('1','new_password',$client_new_pass,'تم اغير كلمه السر بمجاح');
        }else{
            return $this->returnError('E0003','هذا الكود غير صالح');
        }
    }
    public function register_token(Request $request){
        $validator=validator($request->all(),[
            'tokenFireBase'=>'required',
            'type'=>'required|in:android,ios',
        ]);
        if($validator->fails()){
            return $this->responsesData('0', 'validator error', $validator->errors(), 'errors');

        }
        Token::where('tokenFireBase',$request->tokenFireBase)->delete();
        $request->user('clients-api')->tokens()->create($request->all());
        return $this->returnSuccess('تم التسجيل بنجاح','500');
    }
    public function remove_token(Request $request){

    }

}
