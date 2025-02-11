@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.region.add') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("regions.store") }}" method="post">
                        @csrf
                        @foreach($locales as $locale)
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="name_{{$locale->code}}">{{ __('validation.attributes.name') }} ({{$locale->name}})</label>
                                    <input type="text" class="form-control" id="name_{{$locale->code}}" name="name[{{$locale->code}}]" required
                                           value="{{ old('name['.$locale->code.']') }}">
                                    @if($errors->has('name['.$locale->code.']'))
                                        <div class="text-danger">{{ $errors->first('name['.$locale->code.']') }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group text-center">
                            <a href="{{ route('regions.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success" type="submit">{{ __('form.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
