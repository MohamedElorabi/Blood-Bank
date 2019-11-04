



    <div class="form-group">
      <label for="name">@lang('lang.Name Client')</label>
      {!! Form::text('name',null,[
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
      <label for="date_of_birth">@lang('lang.Date_of_birth')</label>
      {!! Form::date('date_of_birth',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="blood_type_id">@lang('lang.Blood Type')</label>
      {!! Form::select('blood_type_id',App\Models\BloodType::pluck('name','id'),old('blood_type_id'),[
          'class' => 'form-control','placeholder'=>'..........'
      ])!!}
    </div>

    <div class="form-group">
      <label for="last_donation_date">@lang('lang.Last Donation Date')</label>
      {!! Form::date('last_donation_date',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="name">@lang('lang.CityName')</label>
      {!! Form::select('city_id',App\Models\City::pluck('name','id'),old('city_id'),[
          'class' => 'form-control','placeholder'=>'..........'
      ])!!}
    </div>

    <div class="form-group">
      <label for="phone">@lang('lang.Phone')</label>
      {!! Form::text('phone',null,[
          'class' => 'form-control'
      ])!!}
    </div>

    <div class="form-group">
      <label for="password">@lang('lang.Password')</label>
      {!! Form::password('password',null,[
          'class' => 'form-control'
      ])!!}
    </div>
