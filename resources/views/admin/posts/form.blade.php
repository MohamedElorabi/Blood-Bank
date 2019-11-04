



    <div class="form-group">
      <label for="title">@lang('lang.Title Post')</label>
      {!! Form::text('title',null,[
          'class' => 'form-control'
      ])!!}

      <label for="description">@lang('lang.Description Post')</label>
      {!! Form::text('description',null,[
          'class' => 'form-control'
      ])!!}

      <label for="content">@lang('lang.Content')</label>
      {!! Form::textarea('content',null,[
          'class' => 'form-control',

      ])!!}

      <label for="image">@lang('lang.Image')</label>
      {!! Form::file('image',null,[
          'class' => 'form-control'
      ])!!}

      <label for="category_id">@lang('lang.category_id')</label>
      {!! Form::select('category_id',App\Models\Category::pluck('name','id'),old('category_id'),[
          'class' => 'form-control','placeholder'=>'..........'
      ])!!}

    </div>
