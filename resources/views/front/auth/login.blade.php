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
                         <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول </li>
                       </ol>
                     </nav>

         </div>
     </div>
     @include('flash::message')
     <div class="row">
   <div class="col-md-12">
       <div class="article-content shadow">
           <p class="content">
               <img  class="log-logo" src="{{asset('front/imgs/logo.png')}}">

               <form action="{{ url('/client-login') }}" method="post">
                 {!! csrf_field() !!}
                       <div class="form-group">

                         <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الجوال">

                       </div>
                       <div class="form-group">

                         <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                       </div>
                       <div class="form-check ">
                         <div class="custom-control custom-checkbox my-1 mr-sm-2">
                           <input type="checkbox" class="custom-control-input" id="customControlInline">
                           <label class="custom-control-label" for="customControlInline">تذكرني</label>
                         </div>


                       </div>
                       
                       <div class="form-btns">
                       <button type="submit" class="btn btn-login">دخول </button>
                       <a class="new-account" href="{{url('client-register')}}"><button type="submit" class="btn btn-new">انشاء حساب جديد </button></a>
                   </div>
                     </form>

       </div>

   </div>

     </div>
 </div>
</section>
@endsection
