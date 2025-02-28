@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card mb-4 shadow-1">
                <div class="card-header"><h4 class="card-header-title">{{ __('content.question') }}</h4></div>
                <div class="card-body">
                    <div class="form-row">
                        @foreach($question->translations as $locale)
                            <div class="col-md-12 mb-3">
                                <label for="title_{{$locale->locale}}">{{ __('content.question') }}
                                    ({{$locale->locale}})</label>
                                <input type="text" class="form-control" id="title_{{$locale->locale}}"
                                       readonly value="{{ $locale->title }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="text_{{$locale->locale}}">{{ __('validation.attributes.description') }}
                                    ({{$locale->locale}})</label>
                                <textarea class="form-control" id="text_{{$locale->locale}}"
                                    readonly rows="3">{{$locale->text}}</textarea>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="nav-tabs-top">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#navs-top-home">{{ __('validation.attributes.image') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#navs-top-profile">{{ __('validation.attributes.video') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#navs-top-bg_image">Background {{ __('validation.attributes.image') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="navs-top-home">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-12 mb-3">
                                            <img class="img-thumbnail" width="80" src="{{asset('storage/'.$question->image)}}" alt="">
                                        </div>
                                        @foreach($question->translations as $locale)
                                            <div class="col-12 mb-2">
                                                <label for="image_title{{$locale->locale}}">{{ __('content.image_title') }} ({{$locale->locale}})</label>
                                                <input type="text" class="form-control" id="image_title{{$locale->locale}}"
                                                       readonly value="{{ $locale->image_title }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-profile">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <video width="100%" height="240" controls src="{{asset('storage/'.$question->video)}}">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-bg_image">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <img class="img-thumbnail" width="80" src="{{asset('storage/'.$question->bgImage)}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="type">{{ __('validation.attributes.type') }}</label>
                        <select class="form-control" id="type" readonly>
                                <option selected ="">{{$question->type}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('content.options') }}</h4>
                    <div class="btn btn-outline-success" id="add_option" style="display: none"><i class="fa fa-plus button-2x">{{ __('form.add') }} {{ __('content.option') }}</i></div>
                </div>
                <div class="card-body">
                    @if($question->type == 'image')
                        @foreach($question->options as $option)
                            <div class="card shadow-1 mb-2">
                                <div class="card-header">
                                    <h4 class="card-header-title"><span class="option_counter">{{$loop->iteration}}</span> @lang('content.option')</h4>
                                    <div class="card-header-btn">
                                        <a href="javascript:void(0)" data-toggle="collapse" class="btn btn-info" data-target="#collapse{{$loop->iteration}}" aria-expanded="true" data-original-title="" title="" data-init="true"><i class="ion-ios-arrow-down"></i></a>
                                    </div>
                                </div>
                                <div class="card-body collapse show" id="collapse{{$loop->iteration}}">
                                    <div class="form-row">
                                        <div class="col-12 text-center mb-3">
                                            <img class="img-thumbnail" width="200" src="{{asset('storage/'.$option->image)}}" alt="">
                                        </div>
                                        @foreach($option->translations as $locale)
                                            <div class="col-6">
                                                <label for="option_image_title{{$locale->locale}}">{{ __('content.image_title') }} ({{$locale->locale}})</label>
                                                <input type="text" class="form-control" id="option_image_title{{$locale->locale}}"
                                                       readonly value="{{ $locale->imageTitle }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($option->nextQuestion)
                                        <div class="mt-3">
                                            <span>@lang('content.next_question'): </span>
                                            <a href="{{route('questions.show', $option->nextQuestion->id)}}" target="_blank">{{$option->nextQuestion->translation->title}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @elseif($question->type == 'radio' || $question->type == 'multiple')
                        @foreach($question->options as $option)
                            <div class="card shadow-1 mb-2">
                                <div class="card-header">
                                    <h4 class="card-header-title"><span class="option_counter">{{$loop->iteration}}</span> @lang('content.option')</h4>
                                    <div class="card-header-btn">
                                        <div class="collapse_btn btn btn-info"><i class="ion-ios-arrow-down"></i></div>
                                    </div>
                                </div>
                                <div class="card-body collapse show">
                                    <div class="form-row">
                                        @foreach($option->translations as $locale)
                                            <div class="col-12 mb-2">
                                                <label for="option_title{{$locale->locale}}">{{ __('content.option') }} ({{$locale->locale}})</label>
                                                <input type="text" class="form-control" id="option_title{{$locale->locale}}"
                                                       readonly value="{{ $locale->title }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($option->nextQuestion)
                                        <div class="mt-2">
                                            <span>@lang('content.next_question'): </span>
                                            <a href="{{route('questions.show', $option->nextQuestion->id)}}">{{$option->nextQuestion->translation->title}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card shadow-1 type_block text_block mb-2">
                            <div class="card-header">
                                <h4 class="card-header-title">@lang('content.option')</h4>
                            </div>
                            <div class="card-body collapse show">
                                <p>@lang('content.text_type')</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group text-center ">
                <a href="{{ route('questions.index') }}" class="btn btn-info">{{{ __('form.cancel') }}}</a>
            </div>
        </div>
    </div>
@endsection
