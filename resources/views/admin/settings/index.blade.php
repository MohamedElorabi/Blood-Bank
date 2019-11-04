@extends('layouts.app')

@section('page_title')
  @lang('lang.Settings')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">@lang('lang.List of Settings')</h3>


    </div>
    <div class="box-body">

      @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('lang.Logo')</th>
              <th>@lang('lang.Phone')</th>
              <th>@lang('lang.Email')</th>
              <th>@lang('lang.FaseBook_Url')</th>
              <th>@lang('lang.Twitter_Url')</th>
              <th>@lang('lang.Youtube_Url')</th>
              <th>@lang('lang.Instagram_Url')</th>
              <th>@lang('lang.WhatsUp_Url')</th>
              <th>@lang('lang.Google_Url')</th>
              <th>@lang('lang.About')</th>
              <th>@lang('lang.Edit')</th>

            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$record->logo}}</td>
              <td>{{$record->phone}}</td>
              <td>{{$record->email}}</td>
              <td>{{$record->fb_url}}</td>
              <td>{{$record->tw_url}}</td>
              <td>{{$record->yt_url}}</td>
              <td>{{$record->ins_url}}</td>
              <td>{{$record->wa_url}}</td>
              <td>{{$record->go_url}}</td>
              <td>{{$record->about}}</td>

              <td class="text-center">
                  <a href="{{url(route('settings.edit' , $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        @else
        <div class="alert alert-danger" role="alert">
          No Data
        </div>
      @endif
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
