<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Setting;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function home(Request $request)
    {
      $donations = DonationRequest::where(function ($q) use ($request) {
          if ($request->blood_type_id) {
              $q->where('blood_type_id', $request->blood_type_id);
          }
          if ($request->governorate_id) {
              $q->whereHas('city', function ($q2) use ($request) {
                  // search in restaurant region "Region" Model
                  $q2->whereCityId($request->governorate_id);
              });
          }
      })->with('city.governorate')->latest()->paginate(6);
      $posts = Post::paginate(6);
      $settings = Setting::first();
      return view('front.home', compact('donations', 'settings', 'posts'));

      // $client = Client::first();
      // auth('client-web')->login($client);
      // $posts = Post::take(9)->get();
      // $donations = DonationRequest::take(9)->get();
      // return view('front.home', compact('posts', 'donations'), ['title' => 'بنك الدم الرئيسية']);
    }


    public function toggleFavourite(Request $request)
    {
        $favourites = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1,'success',$favourites);
    }

    public function articles()
    {
        $settings = Setting::first();
        $posts = Post::paginate(12);
        $fav= Client::with('posts')->where('client_id',auth('client-web')->user()->id)->where('post_id',1);
        return view('front.articles', compact('settings', 'posts', 'fav'));
    }

    public function article($id)
    {
        $post = Post::findOrFail($id);
        $settings = Setting::first();
        $posts = Post::where('category_id', $post->category_id)
                       ->where('id','!=',$post->id)->get();
        return view('front.article', compact('post','settings', 'posts'));
    }

    // public function article(Request $request)
    // {
    //     $post = Post::where('id', $request->id)->get();
    //     return view('front.article', compact('post'), ['title' => 'المقال']);
    // }

    public function about()
    {
      $settings = Setting::first();
      return view('front.about', compact('settings'),['title' => 'عن بنك الدم']);
    }

    public function howWeAre()
    {
      return view('front.how-we-are',['title' => 'من نحن']);
    }

    public function donations()
    {
      $donations = DonationRequest::paginate(5);
      return view('front.donations', compact('donations'), ['title' => 'طلبات التبرع']);
    }

    public function donationDetails(Request $request)
    {
        $donationdetails = DonationRequest::where('id', $request->id)->get();
        return view('front.donation-details', compact('donationdetails'));
    }
    public function contactus()
    {
    $settings = Setting::first();
    return view('front.contact-us',compact('settings'), ['title' => 'اتصل بنا']);
  }

  public function contact_us(Request $request)
  {
      $rules = [
          'name' => 'required',
          'email' => 'required|unique:clients',
          'phone' => 'required|unique:clients',
          'title' => 'required',
          'content' => 'required',
      ];
      $messages = [
          'name.required' => 'يجب كتابه الاسم',
          'email.required' => 'يجب كتابه الايميل',
          'phone.required' => 'يجب كتابه رقم الهاتف',
          'title.required' => 'يجب كتابه الرقم السرى',
          'content.required' => 'يجب كتابه تاريخ الميلاد',
      ];
      $this->validate($request,$rules,$messages);
      $contact = Contact::create($request->all());
      $contact->save();
      flash()->success("تم انشاء الحساب بنجاح");
      return redirect()->back();
    }

    public function donationRequest(Request $request)
    {
//        dd(auth()->guard('client')->user()->name);
        $settings = Setting::first();
        return view('front.donation_request',compact('settings'));
    }

    public function createDonationRequest(Request $request)
    {
        $this->validate($request, [
            'patient_name' => 'required',
            'age' => 'required',
            'blood_type_id' => 'required',
            'bags_num' => 'required',
            'hospital_name' => 'required',
            'latituede' => 'sometimes|nullable',
            'longitude' => 'sometimes|nullable',
            'city_id' => 'required',
            'phone' => 'required',
            'notes' => 'required',
            'client_id' => 'sometimes|nullable'
        ]);

        $record = DonationRequest::create($request->all());
        $record->client_id = auth()->guard('client-web')->user()->id;
        $record->save();
        flash()->success("تمت الاضافه بنجاح");
        return redirect()->back();
    }
}
