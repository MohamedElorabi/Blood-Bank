<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\DonationRequest;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Setting;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
  public function categories()
  {
      $categories = Category::all();

      return responseJson(1,'success', $categories);
  }

  public function searchByCategory(Request $request)
  {
      $posts = Post::where(function($query) use($request) {
          if($request->has('category_id'))
          {
              $query->where('category_id',$request->category_id);
//                ('name' , 'like' , '%' . request('search') . '%')->get();
          }
          })->get();


          return responseJson(1,'success', $posts);
  }


  public function posts()
    {
      $posts = Post::with('category')->paginate(10);
      return responseJson(1, 'success', $posts);
    }

    public function postDetails(Request $request)
    {
        $post = Post::where('id', $request->id)->get();

        return responseJson(1,'success', $post);
    }

    public function governorates()
      {
        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
      }

    public function cities(Request $request)
    {
      $cities = City::where(function ($query) use($request)
      {
        if($request->has('governorate_id'))
        {
            $query->where('governorate_id', $request->governorate_id);
        }
      })->get();
      return responseJson(1, 'success',$cities);
    }

    public function contactUs(Request $request)
    {
        $validator =  validator()->make($request->all() , [
            'name' => 'required',
            'client_id' => 'exists:clients,id',
            'email' =>  'required',
            'phone' =>   'required',
            'title' =>     'required',
            'description' =>    'required'
        ]);


        $contacts = Contact::create($request->all());

        $contacts->save();

        return responseJson(1,'success', $contacts);
    }

    public function settings()
    {
        $settings = Setting::all();

        return responseJson(1,'success', $settings);
    }

    public function favourites(Request $request)
    {
        $favourites = $request->user()->posts()->paginate(10);

        return responseJson(1, 'success', $favourites);
    }

    public function toggleFavourites(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'posts' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $favourites = $request->user()->posts()->toggle($request->posts);
        return responseJson(1, 'success', $favourites);
    }

    public function notification_setting(Request $request)
    {

        $bloodtype = $request->user()->blood_types()->pluck('blood_types.id')->toArray();
        $governorate = $request->user()->governorates()->pluck('governorates.id')->toArray();

        return responseJson(1,'success',[

            'bloodtype' => $bloodtype,
            'governorate' => $governorate

        ]);

    }

    public function update_notification_settings(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'governorates' => 'required',
            'blood_types' => ' required'
        ]);

        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $bloodtype = $request->user()->blood_types()->pluck('blood_type.id')->toArray();
        $governorate = $request->user()->governorates()->pluck('governorates.id')->toArray();

        return responseJson(1,'success',[

            'bloodtype' => $bloodtype,
            'governorate' => $governorate

        ]);

    }

    public function profileEdit(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required|min:2',
            'phone' => 'required|unique:clients|digits:11',
            'email' => 'required|email|unique:clients',
            'password' => 'required|confirmed',
            'city_id' => 'required|exists:cities,id',
            'blood_type_id' => "required",
            'last_donation_date' => 'required',
            'date_of_birth' => 'required'
        ]);


        if ($validator->fails()) {

            return responseJson(0, $validator->errors()->first(), $validator->errors());
            }


        if(request()->has('password')){

            $request->merge(['password' => bcrypt($request->password)]);
        }
        $request->user()->update($request->all());

        return responseJson(1,'تمت التعديل بنجاح',['client' => $request->user()]);
    }

    public function donations()
    {
        $donations = DonationRequest::paginate(10,[
            'patient_name',
            'age',
            'phone',
            'blood_type_id',
            'bags_num',
            'hospital_name',
            'city_id',
            'longitude',
            'latituede',
            'notes',
            'client_id'
        ]);

        return responseJson(1,'success', $donations);
    }


    public function donationDetails(Request $request)
    {
        $donationdetails = DonationRequest::where('id', $request->id)->get();

        return responseJson(1,'success',$donationdetails);
    }

    public function donationRequest(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'patient_name' => 'required',
            'age' => 'required',
            'phone' => 'required|digits:11',
            'blood_type_id' => 'required',
            'bags_num'  => 'required',
            'hospital_name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'longitude'  => 'required',
            'latituede' => 'required',
            'notes'  => 'required',
            'client_id' => 'required'
        ]);

        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        $donationRequest = $request->user()->donation_requests()->create($request->all());
       // find clients suitable for this donation request
        $clientsIds = $donationRequest->city->governorate->clients()
                    ->whereHas('blood_types', function ($q) use ($request,$donationRequest) {
                        $q->where('blood_types.id', $donationRequest->blood_type_id);
                    })->pluck('clients.id')->toArray();
      //dd($clientsIds);

       if (count($clientsIds)) {
           // create a notification on database
           $notification = $donationRequest->notifications()->create([
               'title' => 'يوجد حالة تبرع قريبة منك',
               'content' => $donationRequest->bloodType->name . 'محتاج متبرع لفصيلة ',
           ]);
           // attach clients to this notofication
           $notification->clients()->attach($clientsIds);
           $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
           if (count($tokens))
           {
               //public_path();
               $title = $notification->title;
               $body = $notification->content;
               $data = [
                   'donation_request_id' => $donationRequest->id
               ];
               $send = notifyByFirebase($title, $body, $tokens, $data);
               info("firebase result: " . $send);
//                info("data: " . json_encode($data));
           }
            }

            return 'test';
        }

    }
