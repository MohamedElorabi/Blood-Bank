<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\Setting;
use App\Models\Client;
class AuthController extends Controller
{

    public function register()
   {
       $settings = Setting::first();
       $governorates = Governorate::all();
       return view('front.auth.register',compact('settings','governorates'),['title' => 'تسجيل عضو']);
   }


     public function registerClient(Request $request)
   {
    // return $request->all();

     $ruls = [
       'name' => 'required',
       'email' => 'required|unique:clients',
       'phone' => 'required|unique:clients',
       'password' => 'required',
       'password_confirmation' => 'required',
       'date_of_birth' => 'required',
       'blood_type_id' => 'required',
       'city_id' => 'required',
       'governorate_id' => 'required',
       'last_donation_date' => 'required',
     ];

     $errors= [
       'name.required' => 'يجب كتابه الاسم',
       'email.required' => 'يجب كتابه الايميل',
       'phone.required' => 'يجب كتابه رقم الهاتف',
       'password.required' => 'يجب كتابه الرقم السرى',
       'password.required' => 'يجب كتابه الرقم السرى',
       'date_of_birth.required' => 'يجب كتابه تاريخ الميلاد',
       'brood_type_id.required' => 'يجب كتابه فصيلة الدم',
       'city_id.required' => 'يجب اختيار المدينه',
       'governorate_id.required' => 'يجب اختيار المحافظه',
       'last_donation_date.required' => 'يجب كتابة او اختيار اخر تاريخ للتبرع بالدم'
     ];
            $valedate = validator()->make($request->all(),$ruls,$errors);
            if($valedate->fails())
            {
              return $valedate->errors();
            }

       $request->merge(['password'=>bcrypt($request->password)]);

       $client = Client::create($request->all());
       $client->api_token = str_random(60);
       if($client)
       {
         return redirect('/');
       }else {
         return 'fail';
       }

   }

   // Login
   public function login()
  {
      $settings = Setting::first();
      //dd($governorates);
      return view('front.auth.login',compact('settings'), ['title' => 'تسجيل دخول']);
  }



  public function clientLogin(Request $request)
  {
      $this->validate($request, [
          'phone'    => 'required',
          'password' => 'required',
      ]);
      $client = Client::where('phone', $request->input('phone'))->first();
      if ($client) {
          if (Auth::guard('client-web')->attempt($request->only('phone' ,'password'))) {
              return redirect('/');
          }
          flash()->error('لا يوجد حساب مرتبط بهذا الرقم');
          return back();
      }
  }

  public function logout(){
       auth()->guard('client-web')->logout();
       return redirect('/');
   }



}
