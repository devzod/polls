@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.region.edit') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("regions.update", [$region->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        @foreach($region->translations as $locale)
                        <div class="form-row col-md-12">
                            <div class="col-md-12 mb-3">
                                <label for="name_{{$locale->locale}}">{{ __('validation.attributes.name') }} ({{$locale->locale}})</label>
                                <input type="text" class="form-control" id="name_{{$locale->locale}}" name="name[{{$locale->locale}}]" required
                                       value="{{ old('name['.$locale->locale.']', $locale->name) }}">
                                @if($errors->has('name['.$locale->locale.']'))
                                    <div class="text-danger">{{ $errors->first('name['.$locale->locale.']') }}</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <div class="form-row col-md-12">
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" @checked($region->active) id="customCheck2" name="active">
                                    <label class="custom-control-label" for="customCheck2">{{ __('validation.attributes.status') }}</label>
                                </div>
                                @if($errors->has('active'))
                                    <div class="text-danger">{{ $errors->first('active') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('regions.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success" type="submit">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
