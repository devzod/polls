@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('form.edit') }} {{ __('content.poll') }}</h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("polls.update", $poll->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            @foreach($poll->translations as $locale)
                                <div class="col-md-12 mb-3">
                                    <label for="title_{{$locale->locale}}">{{ __('validation.attributes.name') }}
                                        ({{$locale->locale}})</label>
                                    <input type="text" class="form-control" id="title_{{$locale->locale}}"
                                           name="title[{{$locale->locale}}]" required
                                           value="{{ old('title['.$locale->locale.']', $locale->title) }}">
                                    @if($errors->has('title['.$locale->locale.']'))
                                        <div class="text-danger">{{ $errors->first('title['.$locale->locale.']') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="text_{{$locale->locale}}">{{ __('validation.attributes.description') }}
                                        ({{$locale->locale}})</label>
                                    <textarea class="form-control" id="text_{{$locale->locale}}" name="text[{{$locale->locale}}]" required
                                              rows="5">{{old('text['.$locale->locale.']', $locale->text)}}</textarea>
                                    @if($errors->has('text['.$locale->locale.']'))
                                        <div class="text-danger">{{ $errors->first('text['.$locale->locale.']') }}</div>
                                    @endif
                                </div>
                                <hr>
                            @endforeach
                                <div class="col-md-2">
                                    <select class="custom-select" name="status" required>
                                        @foreach($statuses as $status)
                                            <option @selected($poll->status == $status->value) value="{{$status->value}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('status'))
                                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <a href="{{ route('polls.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-info">{{ __('form.edit') }}</button>
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
