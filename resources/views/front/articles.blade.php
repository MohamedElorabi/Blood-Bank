@extends('front.master')
@section('content')

<section id="breedcrumb" style="
padding-bottom: 2rem;
">
<div class="container">
<div class="row">
  <div class="col-md-12">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="#">المقالات</a></li>
          </ol>
        </nav>

  </div>
</div>
<div class="row">
<section id="articles">
<h2 class="articles-head">المقالات </h2>
<div class="container custom" style="direction: ltr">
<div class="owl-carousel owl-theme" id="owl-articles">
 @foreach($posts as $post)
 <div class="item">
   <div class="card" style="width: 22rem;">
     <i id = "{{$post->id}}", onclick="toggleFavourite(this)"  class="fab fa-gratipay
       {{$post->is_favourite ? 'second-heart' : 'first-heart'}}
       "></i>
     <!---<i  class="fab fa-gratipay second-heart"></i>-->
     <img class="card-img-top" src="{{asset($post->image)}}" alt="Card image cap">
     <div class="card-body">
       <h5 class="card-title">{{$post->title}}</h5>
       <p class="card-text">{{$post->description}}</p>
       <a href="{{url('post/'.$post->id)}}"><button class="btn details-btn">التفاصيل </button></a>
     </div>
   </div>
 </div>
 @endforeach
</div>

</div>
</section>
</div>
</div>
</section>
@endsection
