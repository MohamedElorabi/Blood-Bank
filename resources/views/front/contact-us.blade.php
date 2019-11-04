@extends('front.master')
@section('content')


<!-- breedcrumb-->

 <section id="breedcrumb">
 <div class="container">
     <div class="row">
         <div class="col-md-12">
               <nav aria-label="breadcrumb">
                       <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                         <li class="breadcrumb-item active " aria-current="page">تواصل معنا  </li>
                       </ol>
                     </nav>

         </div>
     </div>
     <div class="row some-breathing-room">

       <div class="col-md-6">
           <div class="call-us-div shadow">
               <div class="div-bg"><p>اتصل بنا </p></div>
               <img class="logo-in-call" src="{{asset('front/imgs/logo.png')}}">
               <hr class="line">
               <ul class="list-call">
                   <li>الجوال:{{$settings->phone}}</li>
                   <li>فاكس :+24556646</li>
                   <li>البريد الاكتروني :{{$settings->email}}</li>
               </ul>
               <p class="call-us-head2">تواصل معنا</p>
               <div class="social-icons">
                       <a href = "{{$settings->fb_url}}" target="_blank"><i class="fab fa-facebook-square hvr-forward"></i></a>
                       <a href = "{{$settings->tw_url}}" target="_blank"><i class="fab fa-twitter-square hvr-forward"></i></a>
                       <a href = "{{$settings->yt_url}}" target="_blank"><i class="fab fa-youtube-square hvr-forward"></i></a>
                       <a href = "{{$settings->go_url}}" target="_blank"><i class="fab fa-google-plus-square hvr-forward"></i></a>
                       <a href = "{{$settings->wa_url}}" target="_blank"><i class="fab fa-whatsapp-square hvr-forward"></i></a>
               </div>
           </div>

       </div>
       @include('flash::message')
       <div class="col-md-6">
               <div class="call-us-div shadow">
                       <div class="div-bg"><p>اتصل بنا </p></div>
                       <form action="/contact-us" method="post">
                                {{ csrf_field() }}
                               <div class="form-group some-space {{ $errors->has('name') ? ' has-error' : '' }}">

                                       <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم">
                                       @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                              </div>
                               <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                                 <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الاكتروني">
                                 @if ($errors->has('email'))
                                   <span class="help-block">
                                       <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                                @endif
                               </div>
                               <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">

                                       <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الجوال">
                                       @if ($errors->has('phone'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('phone') }}</strong>
                                         </span>
                                       @endif
                                     </div>
                                     <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">

                                           <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عنوان الرساله">
                                           @if ($errors->has('title'))
                                                 <span class="help-block">
                                                     <strong>{{ $errors->first('title') }}</strong>
                                                 </span>
                                           @endif
                                         </div>
                                         <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">

                                           <textarea class="form-control" name="content" id="exampleFormControlTextarea1" placeholder="نص الرساله" rows="3"></textarea>
                                           <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                           @if ($errors->has('content'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('content') }}</strong>
                                              </span>
                                          @endif
                                       </div>
                               <button type="submit" class="btn btn-send-call hvr-float">ارسال</button>
                             </form>


                   </div>

       </div>


     </div>
 </div>
</section>
@endsection
