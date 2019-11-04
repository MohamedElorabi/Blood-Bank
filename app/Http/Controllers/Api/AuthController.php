<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Token;
use App\Mail\ResetPassword;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $validator = validator()->make($request->all(),[
        'name' => 'required',
        'email' => 'required|unique:clients',
        'date_of_birth' => 'required',
        'blood_type_id' => 'required',
        'last_donation_date' => 'required',
        'city_id' => 'required',
        'phone' => 'required',
        'password' => 'required|confirmed',
      ]);

      if ($validator->fails())
      {
        return responseJson(0,$validator->errors()->first(),$validator->errors());
      }

      $request->merge(['password' => bcrypt($request->password)]);
      $client = Client::create($request->all());
      $client->api_token = str_random(60);
      $client->save();
      return responseJson(1,'تم الاضافة بنجاح',[
        'api_token' => $client -> api_token,
        'client' => $client
      ]);
    }

    public function login(Request $request)
    {
      $validator = validator()->make($request->all(),[
        'phone' => 'required',
        'password' => 'required',
      ]);

      if ($validator->fails())
      {
        return responseJson(0,$validator->errors()->first(),$validator->errors());
      }

      $client = Client::where('phone',$request->phone)->first();
      if($client)
      {
          if(Hash::check($request->password,$client->password))
          {
              return responseJson(1,'تم تسجيل الدخول بنجاح',[
                'api_token' => $client->api_token,
                'client' =>$client
              ]);
          }else{
            return responseJson(0,'بيانات الدخول غير صحيحة');
          }
      }else{
          return responseJson(0,'بيانات الدخول غير صحيحة');
      }

    }


    public function resetPassword(Request $request)
    {
      $validation = validator()->make($request->all(),[
        'phone' => 'required',

      ]);

      if ($validation->fails()){
        $data = $validation->errors();
        return responseJson(0,$validation->errors()->first(),$data);
      }


    $client = Client::where('phone',$request->phone)->first();
    if($client)
    {
      $code = rand(1111,9999);
      $update = $client->update(['pin_code' => $code]);
      if($update){
        // send email
        Mail::to($client->email)
          ->bcc("elorabi199@gmail.com")
          ->send(new ResetPassword($code));

          return responseJson(1,'برجاء فحص هاتفك',
          [
            'pin_code_for_test' => $code,
          ]);
      }else{
        return responseJson(0,'حدث خطأ. حاول مرة أخرى ');
      }
    }else{
        return responseJson(0, 'لا يوجد اى حساب مرتبط بهذا الهاتف');
    }

  }

  public function newPassword(Request $request)
  {
      $validation = validator()->make($request->all(), [
        'pin_code' => 'required',
        'phone' => 'required',
        'password' => 'required|confirmed'
      ]);

      if ($validation->fails()) {

        return responseJson(0, $validation->errors()->first(),$data);

      }

      $client = Client::where('pin_code', $request->pin_code)->where('pin_code','!=',0)
      ->where('phone',$request->phone)->first();

      if($client)
      {
        $client->password = bcrypt($request->password);
        $client->pin_code = null;

        if($client->save())
        {
          return responseJson(1, 'تم تغيير كلمة المروو بنجاح');
        }else{
          return responseJson(0, 'حدث خطأ , حاول مرة أخرى');
        }
      }else{
        return responseJson(0, 'هذا الكود غير صالح');
      }
  }


  public function registerToken(Request $request)
  {
      $validator = validator()->make($request->all(),[

          'token' => 'required',
          'type' => 'required|in:android,ios'

      ]);

      if ($validator->fails()) {

          return responseJson(0, $validator->errors()->first(), $validator->errors());
      }

      Token::where('token',$request->token)->delete();
      $request->user()->tokens()->create($request->all());
      return responseJson(1,'تم التسجيل بنجاح ');
  }

  public function removeToken(Request $request)
  {
      $validator = validator()->make($request->all(),[
          'token' => 'required'
      ]);

      if ($validator->fails()) {
          $data = $validator->errors();
          return responseJson(0, $validator->errors()->first(), $data);
      }

      Token::where('token',$request->token)->delete();

      return responseJson(1,'تم المسح بنجاح ');
  }
}
