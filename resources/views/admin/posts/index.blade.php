@extends('layouts.app')

@section('page_title')
  @lang('lang.List of Posts')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">

    <div class="box-body">
      <a href="{{url('admin/posts/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('lang.New Post')</a>
      @include('flash::message')
      @if(count($records))
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>@lang('lang.Title Post')</th>
              <th>@lang('lang.Description Post')</th>
              <th>@lang('lang.Image')</th>
              <th>@lang('lang.category_id')</th>
              <th class="text-center">@lang('lang.Edit')</th>
              <th class="text-center">@lang('lang.Delete')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($records as $record)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$record->title}}</td>
              <td>{{$record->description}}</td>
              <td><img src="../../{{$record->image}}" style="height: 50px;"></td>
              <td>{{$record->category->name}}</td>
              <td class="text-center">
                  <a href="{{url(route('posts.edit' , $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
              </td>
              <td class="text-center">
                {!! Form::open([
                  'action' => ['Admin\PostController@destroy',$record->id],
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
        @lang('lang. No Data')
        </div>
      @endif
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
