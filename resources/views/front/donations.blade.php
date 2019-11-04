@extends('front.master')
@section('content')

<!-- breedcrumb-->

<section id="breedcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="Home.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                          </ol>
                        </nav>

            </div>
        </div>
        </div>

<h2 class="donations-head horizntal-line">طلبات التبرع </h2>

 <!-- Donations offers  -->
<section id="donations">
<div class="container custom-position">
<div class="row  dropdown">
<div class="col-md-5">
    <select class="custom-select">
        <option selected>اختر فصيلة الدم </option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
</div>

<div class="col-md-5">
    <select class="custom-select">
        <option selected>اختر المدينة </option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>

</div>
<div class="col-md-2 search">
<div class="circle search-icon"><i class="fas fa-search search-icon"></i></div>

</div>

</div>

@foreach($donations as $donation)
<div class="row background-div ">
<div class="col-lg-2">
<div class="blood-type border-circle">
<div class="blood-txt">
    {{$donation->blood_type->name}}
</div>

</div>
</div>
<div class="col-lg-7">
<ul class="order-details">
  <li class="cutom-display">   اسم الحالة:</li>
  <span class="cutom-display">{{$donation->patient_name}}</span> <br>

  <li class="cutom-display custom-padding" >  مستشفي:</li>
  <span class="cutom-display custom-padding">{{$donation->hospital_name}}</span> <br>
  <div class="adjust-position">  <li class="cutom-display ">  المدينة:</li>
    <span class="cutom-display ">{{$donation->city->name}}</span></div>


</ul>

</div>
<div class="col-lg-3">
    <a href="{{url('donations/'.$donation->id)}}"><button class="btn more2-btn">التفاصيل </button></a>
</div>

</div>
@endforeach

<div class="container text-center">
  <div class="text-center" style="....">{{$donations->links()}}</div>
</div>
</div>
</section>

@endsection
