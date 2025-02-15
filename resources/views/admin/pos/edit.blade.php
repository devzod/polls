@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('form.edit') }} {{ __('content.pos') }}</h4>
                </div>
                <div class="card-body collapse show" id="collapse8">
                    <form class="needs-validation" action="{{ route("pos.update", $pos->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="username2">{{ __('validation.attributes.name') }}</label>
                                <input type="text" class="form-control" id="username2" name="name" required value="{{ $pos->name }}">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="phone">{{ __('validation.attributes.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$pos->phone}}" required>
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="region_id">{{ __('form.region.region') }}</label>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="region_id" name="region_id" required>
                                    <option value="" selected disabled>{{ __('form.region.regions') }} {{ __('form.choose') }}</option>
                                    @foreach($regions as $region)
                                        <option
                                            value="{{ $region->id }}"
                                            @selected($pos->region_id == $region->id)
                                        >{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('region_id'))
                                    <div class="text-danger">{{ $errors->first('region_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address">{{ __('validation.attributes.address') }}</label>
                                <textarea type="text" class="form-control" id="address" name="address" required rows="5">{{$pos->address}}</textarea>
                                @if($errors->has('address'))
                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="latitude">{{ __('content.latitude') }} (latitude)</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{$pos->latitude}}" >
                                @if($errors->has('latitude'))
                                    <div class="text-danger">{{ $errors->first('latitude') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude">{{ __('content.longitude') }} (longitude)</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{$pos->longitude}}">
                                @if($errors->has('longitude'))
                                    <div class="text-danger">{{ $errors->first('longitude') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" @checked($pos->status) id="customCheck2" name="status" value="1">
                                    <label class="custom-control-label" for="customCheck2">Статус</label>
                                </div>
                                @if($errors->has('status'))
                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <a href="{{ route('pos.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
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
