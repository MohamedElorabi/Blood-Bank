



    <div class="form-group">
      <label for="name">@lang('lang.CityName')</label>
      {!! Form::text('name',null,[
          'class' => 'form-control'
      ])!!}

    </div>

    <div class="form-group">
      <label for="governorate_id">@lang('lang.governorate_name')</label>
      {!! Form::select('governorate_id',App\Models\Governorate::pluck('name','id'),old('governorate_id'),[
          'class' => 'form-control','placeholder'=>'..........'
      ])!!}

    </div>
