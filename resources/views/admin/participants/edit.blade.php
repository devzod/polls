@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('form.edit') }} {{ __('content.participant') }}</h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("participants.update", $participant->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('validation.attributes.name') }}</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" required value="{{ $participant->name }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone">{{ __('validation.attributes.phone') }}</label>
                                <input type="text" class="form-control" id="phone"
                                       name="phone" required value="{{ $participant->phone }}">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="birthday">{{ __('validation.attributes.date') }}</label>
                                <input type="date" class="form-control" id="birthday"
                                       name="birthday" value="{{ $participant->birthday }}">
                                @if($errors->has('birthday'))
                                    <div class="text-danger">{{ $errors->first('birthday') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-radio">
                                    <input name="gender" type="radio" class="custom-control-input" @checked($participant->gender == "male") id="male" value="male">
                                    <label class="custom-control-label" for="male">@lang('content.male')</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input name="gender" type="radio" class="custom-control-input" @checked($participant->gender == "female") id="female" value="female">
                                    <label class="custom-control-label" for="female">@lang('content.female')</label>
                                </div>
                                @if($errors->has('gender'))
                                    <div class="text-danger">{{ $errors->first('gender') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" @checked($participant->status) id="customCheck2" name="status" value="1">
                                    <label class="custom-control-label" for="customCheck2">Статус</label>
                                </div>
                                @if($errors->has('status'))
                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <a href="{{ route('participants.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
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
