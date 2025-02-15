@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('form.edit') }} {{ __('content.stuff') }}</h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("stuff.update", $stuff->id) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('validation.attributes.name') }}</label>
                                <input type="text" class="form-control" id="name"
                                       name="name" required value="{{ $stuff->name }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone">{{ __('validation.attributes.phone') }}</label>
                                <input type="text" class="form-control" id="phone"
                                       name="phone" required value="{{ $stuff->phone }}">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="login">{{ __('validation.attributes.login') }}</label>
                                <input type="text" class="form-control" id="login"
                                       name="login" required value="{{ $stuff->login }}">
                                @if($errors->has('login'))
                                    <div class="text-danger">{{ $errors->first('login') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="password">{{ __('validation.attributes.password') }}</label>
                                <input type="text" class="form-control" id="password" name="password">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" @checked($stuff->status) id="customCheck2" name="status">
                                    <label class="custom-control-label" for="customCheck2">Статус</label>
                                </div>
                                @if($errors->has('status'))
                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <a href="{{ route('stuff.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
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
