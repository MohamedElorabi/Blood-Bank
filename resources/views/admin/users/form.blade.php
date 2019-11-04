
@inject('role', 'App\Models\Role');

<?php
$roles = $role->pluck('display_name', 'id')->toArray();
?>


    <div class="form-group">
      <label for="name">@lang('lang.Name')</label>
      {!! Form::text('name',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="name">@lang('lang.Email')</label>
      {!! Form::email('email',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="password">@lang('lang.Password')</label>
      {!! Form::password('password',[
          'class' => 'form-control'
      ])!!}
    </div>

    <!-- <div class="form-group">
      <label for="password_confirmation">Password Confirmation</label>
      {!! Form::password('password_confirmation',[
          'class' => 'form-control'
      ])!!}
    </div> -->

    <div class="form-group">
      <label for="roles_list">@lang('lang.Role List')</label>
      {!! Form::select('roles_list[]',$roles,null,[
          'class' => 'form-control',
          'multiple'  => 'multiple'
      ])!!}
    </div>
