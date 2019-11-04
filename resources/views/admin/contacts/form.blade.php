



    <div class="form-group">
      <label for="name">@lang('lang.Name')</label>
      {!! Form::text('name',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="email">@lang('lang.Email')</label>
      {!! Form::text('email',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="phone">@lang('lang.Phone')</label>
      {!! Form::text('phone',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="title">@lang('lang.Title')</label>
      {!! Form::text('title',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="content">@lang('lang.Content')</label>
      {!! Form::textarea('content',null,[
          'class' => 'form-control'
      ])!!}
    </div>
