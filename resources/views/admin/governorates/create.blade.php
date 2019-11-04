@extends('layouts.app')
@inject('model','App\Models\Governorate')
@section('page_title')
@lang('lang.Create Governorate')
@endsection
@section('content')



<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-body">
      {!! Form::model($model,[
          'action'  => 'Admin\GovernorateController@store'
        ]) !!}
      @include('partials.validation')
      @include('admin.governorates.form')
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
