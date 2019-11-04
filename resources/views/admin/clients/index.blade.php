@extends('layouts.app')

@section('page_title')
  @lang('lang.List of Clients')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">

    <div class="box-body">
      <a href="{{url('admin/clients/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('lang.New Clients')</a>
      @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('lang.Name Client')</th>
              <th>@lang('lang.Email')</th>
              <th>@lang('lang.Date Of Birth')</th>
              <th>@lang('lang.Blood Type')</th>
              <th>@lang('lang.Last Donation Date')</th>
              <th>@lang('lang.CityName')</th>
              <th>@lang('lang.Phone')</th>
              <th>@lang('lang.Status')</th>
              <th class="text-center">@lang('lang.Edit')</th>
              <th class="text-center">@lang('lang.Delete')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$record->name}}</td>
              <td>{{$record->email}}</td>
              <td>{{$record->date_of_birth}}</td>
              <td>{{$record->blood_type->name}}</td>
              <td>{{$record->last_donation_date}}</td>
              <td>{{$record->city->name}}</td>
              <td>{{$record->phone}}</td>
              @if($record->is_active == 1)
                   <td class="text-center">
                       <a href="active/{{$record->id}}">
                           <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Active</button>
                       </a>
                   </td>
               @else
                   <td class="text-center">
                       <a href="disactive/{{$record->id}}">
                           <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-edit"></i>De Active</button>
                       </a>
                   </td>
               @endif

              <td class="text-center">
                  <a href="{{url(route('clients.edit' , $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
              </td>
              <td class="text-center">
                {!! Form::open([
                  'action' => ['Admin\CategoryController@destroy',$record->id],
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
