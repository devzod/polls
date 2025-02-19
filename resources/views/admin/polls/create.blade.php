@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('form.add') }} {{ __('content.polls') }}</h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("polls.store") }}" method="post">
                        @csrf
                        <div class="form-row">
                            @foreach($locales as $locale)
                                <div class="col-md-12 mb-3">
                                    <label for="title_{{$locale->code}}">{{ __('validation.attributes.name') }}
                                        ({{$locale->name}})</label>
                                    <input type="text" class="form-control" id="title_{{$locale->code}}"
                                           name="title[{{$locale->code}}]" required
                                           value="{{ old('title['.$locale->code.']') }}">
                                    @if($errors->has('title['.$locale->code.']'))
                                        <div class="text-danger">{{ $errors->first('title['.$locale->code.']') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="text_{{$locale->code}}">{{ __('validation.attributes.description') }}
                                        ({{$locale->name}})</label>
                                    <textarea class="form-control" id="text_{{$locale->code}}" name="text[{{$locale->code}}]" required
                                              rows="5">{{old("text['.$locale->code.']")}}</textarea>
                                    @if($errors->has('text['.$locale->code.']'))
                                        <div class="text-danger">{{ $errors->first('text['.$locale->code.']') }}</div>
                                    @endif
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <div class="form-group text-center ">
                            <a href="{{ route('polls.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-info">{{ __('form.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/formatter/jquery.formatter.min.js') }}"></script>
    <script src="{{ asset('assets/js/formatter.js') }}"></script>
@endsection
