@extends('front.master')
@section('content')
<section id="breedcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">عن بنك الدم </li>
                          </ol>
                        </nav>

            </div>
            <div class="col-md-12">
                <div class="who-are-we shadow">
                <img class="we-logo" src="{{asset('front/imgs/logo.png')}}">
                <p class="who-text">
                    {{$settings->about}}
                </div>


            </div>
        </div>
        </div>

@endsection
