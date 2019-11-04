



    <div class="form-group">
      <label for="logo">@lang('lang.Logo')</label>
      {!! Form::file('logo',null,[
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
      <label for="email">@lang('lang.Email')</label>
      {!! Form::email('email',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="fb_url">@lang('lang.Phone')FaseBook_Url</label>
      {!! Form::text('fb_url',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="tw_url">@lang('lang.Twitter_Url')</label>
      {!! Form::text('tw_url',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="yt_url">@lang('lang.Youtube_Url')</label>
      {!! Form::text('yt_url',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="ins_url">@lang('lang.Instagram_Url')</label>
      {!! Form::text('ins_url',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="wa_url">@lang('lang.WhatsUp_Url')</label>
      {!! Form::text('wa_url',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="go_url">@lang('lang.Google_Url')</label>
      {!! Form::text('go_url',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="about">@lang('lang.About')</label>
      {!! Form::textarea('about',null,[
          'class' => 'form-control'
      ])!!}
    </div>
