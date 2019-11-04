@extends('layouts.app')
@inject('model','App\Models\Post')
@section('page_title')
  @lang('lang.Create Post')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <!-- <h3 class="box-title">Create Post</h3> -->

    </div>
    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\PostController@store',
          'files' => true
        ]) !!}
      @include('partials.validation')
      @include('admin.posts.form')
      <div class="form-group">
        <button class="btn btn-primary" type="submit">@lang('lang.submit')</button>
      </div>
      {!! Form::close() !!}

    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
