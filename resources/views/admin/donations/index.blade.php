@extends('layouts.app')
@inject('DonationRequest', 'App\Models\DonationRequest')
@section('page_title')
  @lang('lang.DonationRequest')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('lang.List of DonationRequest')</h3>


    </div>
    <div class="box-body">

      @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('lang.PatientName')</th>
              <th>@lang('lang.Age')</th>
              <th>@lang('lang.Blood Type')</th>
              <th>@lang('lang.Bags Num')</th>
              <th>@lang('lang.Hospital Name')</th>
              <th>@lang('lang.City Id')</th>
              <th>@lang('lang.Longitude')</th>
              <th>@lang('lang.Latituede')</th>
              <th>@lang('lang.Phone')</th>
              <th>@lang('lang.Notes')</th>
              <th>@lang('lang.Client Id')</th>
              <th class="text-center">@lang('lang.Show')</th>
              <th class="text-center">@lang('lang.Delete')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$record->patient_name}}</td>
              <td>{{$record->age}}</td>
              <td>{{$record->blood_type->name}}</td>
              <td>{{$record->bags_num}}</td>
              <td>{{$record->hospital_name}}</td>
              <td>{{$record->city->name}}</td>
              <td>{{$record->longitude}}</td>
              <td>{{$record->latituede}}</td>
              <td>{{$record->phone}}</td>
              <td>{{$record->notes}}</td>
              <td>{{$record->client->name}}</td>
              <td class="text-center">
                  <a href="{{url(route('donations.show' , $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
              </td>
              <td class="text-center">
                {!! Form::open([
                  'action' => ['Admin\DonationRequestController@destroy',$record->id],
                  'method' => 'delete'
                  ])!!}
                  <button type="submit" class="delete_link btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        @else
        <div class="alert alert-danger" role="alert">
          @lang('lang.No Data')
        </div>
      @endif
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
