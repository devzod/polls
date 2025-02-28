@extends('layouts.main')
@section('content')
    @if(session()->get('errors'))
        @dump( session()->get('errors')->first());
    @endif
    <div class="row">
        <form class="col-4" method="POST" action="{{route('questions.update', $question->id)}}" enctype="multipart/form-data">
            <div class="card mb-4 shadow-1">
                <div class="card-header"><h4 class="card-header-title">{{ __('content.question') }}</h4></div>
                <div class="card-body">
                    <div class="form-row">
                        @csrf
                        @method('PUT')
                        @foreach($locales as $locale)
                            @php
                                $translation = $question->translations->firstWhere('locale', $locale->code);
                            @endphp
                            <div class="col-md-12 mb-3">
                                <label for="title_{{$locale->code}}">{{ __('content.question') }}
                                    ({{$locale->name}})</label>
                                <input type="text" class="form-control" id="title_{{$locale->code}}"
                                       name="title[{{$locale->code}}]" required
                                       value="{{ $translation->title}}">
                                @if($errors->has('title['.$locale->code.']'))
                                    <div class="text-danger">{{ $errors->first('title['.$locale->code.']') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="text_{{$locale->code}}">{{ __('validation.attributes.description') }}
                                    ({{$locale->name}})</label>
                                <textarea class="form-control" id="text_{{$locale->code}}"
                                          name="text[{{$locale->code}}]"
                                          rows="3">{{$translation->text}}</textarea>
                                @if($errors->has('text['.$locale->code.']'))
                                    <div class="text-danger">{{ $errors->first('text['.$locale->code.']') }}</div>
                                @endif
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
                                            @if($question->image)
                                                <div class="mb-2"><img class="img-thumbnail" width="100" src="{{asset('storage/'.$question->image)}}" alt=""></div>
                                            @endif
                                            <label for="image">{{ __('validation.attributes.image') }}</label>
                                            <input type="file" class="form-control" id="image"
                                                   name="image" value="{{ old('image') }}"
                                                   accept="image/png, image/gif, image/jpeg, image/heic, image/svg">
                                            @if($errors->has('image'))
                                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                        @foreach($locales as $locale)
                                            @php
                                                $translation = $question->translations->firstWhere('locale', $locale->code);
                                            @endphp
                                            <div class="col-12 mb-2">
                                                <label for="image_title{{$locale->code}}">{{ __('content.image_title') }} ({{$locale->name}})</label>
                                                <input type="text" class="form-control" id="image_title{{$locale->code}}"
                                                       name="image_title[{{$locale->code}}]" value="{{ old('image_title['.$locale->code.']', $translation->image_title) }}">
                                                @if($errors->has('image_title['.$locale->code.']'))
                                                    <div class="text-danger">{{ $errors->first('image_title['.$locale->code.']') }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-profile">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            @if($question->video)
                                                <div class="mb-2">
                                                    <video src="{{asset('storage/'.$question->video)}}" controls width="100%" height="240"></video>
                                                </div>
                                            @endif
                                            <label for="video">{{ __('validation.attributes.video') }}</label>
                                            <input type="file" class="form-control" id="video"
                                                   name="video" value="{{ old('video') }}">
                                            @if($errors->has('video'))
                                                <div class="text-danger">{{ $errors->first('video') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-bg_image">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            @if($question->bgImage)
                                                <div class="mb-2"><img class="img-thumbnail" width="100" src="{{asset('storage/'.$question->bgImage)}}" alt=""></div>
                                            @endif
                                            <label for="bg_image">{{ __('validation.attributes.image') }}</label>
                                            <input type="file" class="form-control" id="bg_image"
                                                   name="bg_image" value="{{ old('bg_image') }}">
                                            @if($errors->has('bg_image'))
                                                <div class="text-danger">{{ $errors->first('bg_image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="type">{{ __('validation.attributes.type') }}</label>
                        <select class="form-control" id="type" name="type" required>
                            <option selected disabled>{{ __('form.choose') }} {{ __('validation.attributes.type') }}</option>
                            @foreach($types as $type)
                                <option value="{{$type->value}}" @selected(old('type', $question->type) == $type->value)>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type'))
                            <div class="text-danger">{{ $errors->first('type') }}</div>
                        @endif
                    </div>
                    <button class="btn btn-info mt-3">{{ __('form.edit') }}</button>
                </div>
            </div>
        </form>
        <div class="col-8">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">{{ __('content.options') }}</h4>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#m_modal_2"><i class="fa fa-plus button-2x"></i> {{ __('form.add') }} {{ __('content.option') }}</button>
                </div>
                <div class="card-body" id="options_block">
                    @foreach($question->options as $option)
                        <div class="card shadow-1 mb-2 type_block image_block">
                            <div class="card-header">
                                <h4 class="card-header-title"><span
                                        class="option_counter">{{$loop->iteration}}</span> @lang('content.option')</h4>
                                @if(!$option->nextQuestion)
                                    <button type="button" class="btn btn-outline-success addInQuestion mr-2"
                                            data-option="1">
                                        <i class="fa fa-plus button-2x">{{ __('form.add') }} {{ __('content.in_question') }}</i>
                                    </button>
                                @endif
                                <div class="card-header-btn" style="font-size: 0">
                                    <a href="javascript:void(0)" data-toggle="collapse" class="btn btn-info"
                                       data-target="#collapse{{$loop->iteration}}" aria-expanded="true"
                                       data-original-title="" title="" data-init="true"><i
                                            class="ion-ios-arrow-down"></i></a>
                                    <form action="{{ route("options.delete", [$option->id]) }}" method="post"
                                          onsubmit="return confirm(this.getAttribute('data-message'));"
                                          data-message="{{ __('content.confirm_delete') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger ml-2"><i
                                                class="ion-ios-trash-outline"></i></button>
                                    </form>
                                </div>
                            </div>
                            <form class="card-body collapse show" action="{{route('options.update', $option->id)}}" id="collapse{{$loop->iteration}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="next_question_id" class="next_question_id" value="{{$option->nextQuestionId}}">
                                @if($question->type == 'image')
                                    <div class="form-row">
                                        <div class="col-12 text-center mb-3">
                                            <img class="img-thumbnail" width="200" src="{{asset('storage/'.$option->image)}}" alt="">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="option_image">Изображение</label>
                                            <input type="file" class="form-control" id="option_image"
                                                   name="option_image"
                                                   accept="image/png, image/gif, image/jpeg, image/heic, image/svg">
                                            @if($errors->has('option_image'))
                                                <div class="text-danger">{{ $errors->first('option_image') }}</div>
                                            @endif
                                        </div>
                                        @foreach($option->translations as $locale)
                                            <div class="col-6">
                                                <label
                                                    for="option_image_title{{$locale->locale}}">{{ __('content.image_title') }}
                                                    ({{$locale->locale}})</label>
                                                <input type="text" class="form-control"
                                                       id="option_image_title{{$locale->locale}}"
                                                       name="option_image_title[{{$locale->locale}}]"
                                                       value="{{ $locale->imageTitle }}">
                                                @if($errors->has('option_image_title['.$locale->locale.']'))
                                                    <div
                                                        class="text-danger">{{ $errors->first('option_image_title['.$locale->locale.']') }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($question->type == 'radio' || $question->type == 'multiple')
                                    <div class="form-row">
                                        @foreach($option->translations as $locale)
                                            <div class="col-12 mb-2">
                                                <label for="option_title{{$locale->locale}}">{{ __('content.option') }}
                                                    ({{$locale->locale}})</label>
                                                <input type="text" class="form-control"
                                                       id="option_title{{$locale->locale}}"
                                                       value="{{ $locale->title }}">
                                                @if($errors->has('option_title['.$locale->locale.']'))
                                                    <div
                                                        class="text-danger">{{ $errors->first('option_title['.$locale->locale.']') }}</div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>@lang('content.text_type')</p>
                                @endif
                                <div class="nextQuestionLink">
                                    @if($option->nextQuestion)
                                        <div class="mt-3 d-flex align-items-center">
                                            <span>@lang('content.next_question'): </span>
                                            <a href="{{route('questions.show', $option->nextQuestion->id)}}"
                                               target="_blank">{{$option->nextQuestion->translation->title}}</a>
                                            <form action="{{ route("options.removeNext", [$option->id]) }}"
                                                  method="post"
                                                  onsubmit="return confirm(this.getAttribute('data-message'));"
                                                  data-message="{{ __('content.confirm_delete') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger ml-2"><i
                                                        class="ion-ios-trash"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">@lang('form.save')</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group text-center ">
                <a href="{{ route('questions.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
            </div>
        </div>
    </div>
    <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true" data-option="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel_1">@lang('form.choose') @lang('content.question')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control mb-2" type="search" name="title" id="questionTitle" placeholder="Search" value="">
                    <select class="form-control" name="question" id="selectBlock" required>
                        <option value="">@lang('form.choose') @lang('content.question')</option>
                        @foreach($allQuestions as $question)
                            <option class="nextQuestion" value="{{$question->id}}">{{$question->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="{{ route("questions.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }} {{__('form.new')}} {{ __('content.question') }}</i></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('form.close')</button>
                    <button type="button" class="btn btn-primary" id="addNextQuestion">@lang('form.save')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{{route('options.store', $question->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel_1">@lang('form.add') @lang('content.option')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('form.close')</button>
                    <button type="button" class="btn btn-primary" id="addNextQuestion">@lang('form.save')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.collapse_btn',function () {
                $(this).closest('.type_block').children('.card-body').toggleClass('show');
            })

            $("#questionTitle").keyup(function (){
                const title = $(this).val().toLowerCase();
                $('.nextQuestion').each(function () {
                    let optionText = $(this).text().toLowerCase();
                    if (optionText.includes(title.toLowerCase()) || title === "") {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            var myModal = new bootstrap.Modal(document.getElementById('m_modal_1'));
            const modal = $("#m_modal_1")
            $(document).on('click', '.addInQuestion', function () {
                const option = $(this).data('option');
                console.log('btn option', option)
                modal.data('option', option);
                myModal.show();
            });

            $("#addNextQuestion").click(function (){
                const option = modal.data('option')
                console.log('modal option', option)
                const questionId = $("#selectBlock").val()
                let url = '{{ route("questions.show", ":id") }}';
                url = url.replace(':id', questionId);
                const nextQuestionLink = `<div class="mt-3">
                                            <span>@lang('content.next_question'): </span>
                                            <a target="_blank" href="${url}">${$("#selectBlock option:selected").text()}</a>
                                            <div class="delete_next_question_btn btn btn-sm btn-danger ml-3"><i class="ion-ios-trash"></i></div>
                                        </div>`
                console.log('block:', $('.addInQuestion[data-option="' + option + '"]'))
                $('.addInQuestion').each(function () {
                    console.log('data', $(this).data('option'))
                    if($(this).data('option') === option) {
                        $(this).closest('.type_block').find('.next_question_id').val(questionId)
                        $(this).closest('.type_block').find('.nextQuestionLink').html(nextQuestionLink)
                        $("#selectBlock").val('')
                        console.log('value:', $(this).closest('.type_block').find('.next_question_id').val())
                    }
                });
                myModal.hide();
            });

            $(document).on('click', '.delete_next_question_btn', function (){
                $(this).closest('.type_block').find('.next_question_id').val('')
                $(this).closest('.nextQuestionLink').html("")
            })

        });
    </script>
@endsection
