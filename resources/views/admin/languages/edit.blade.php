@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.locale.edit') }}
                    </h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("languages.update", [$item->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row col-md-12">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('validation.attributes.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required
                                       value="{{ $item->name }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('validation.attributes.code') }}</label>
                                <input type="text" class="form-control" id="code" name="code" required
                                       value="{{ $item->code }}">
                                @if($errors->has('code'))
                                    <div class="text-danger">{{ $errors->first('code') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row col-md-12">
                            <img class="img-thumbnail" width="100" src="{{asset('storage/').$item->icon}}" alt="icon">
                            <div class="col-md-12 mb-3">
                                <label for="name">{{ __('validation.attributes.icon') }}</label>
                                <input type="file" class="form-control" id="icon" name="icon">
                                @if($errors->has('icon'))
                                    <div class="text-danger">{{ $errors->first('icon') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('languages.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success" type="submit">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
