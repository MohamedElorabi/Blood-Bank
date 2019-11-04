@extends('layouts.app')
@inject('model','App\Models\Contact')
@section('page_title')
  @lang('lang.Create Contact')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">

    </div>
    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\ContactController@store'
        ]) !!}
      @include('partials.validation')
      @include('admin.contacts.form')
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
