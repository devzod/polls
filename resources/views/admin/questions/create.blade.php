@extends('layouts.main')
@section('content')
    <form class="row" method="POST" action="{{route('polls.questions.store', $poll->id)}}" enctype="multipart/form-data">
        <div class="col-12 mt-3">
            <h4 class="text-center">@lang('content.question') : {{ $poll->title }}</h4>
        </div>
        <div class="col-4">
            <div class="card mb-4 shadow-1">
                <div class="card-header"><h4 class="card-header-title">{{ __('content.question') }}</h4></div>
                <div class="card-body">
                    <div class="form-row">
                        @csrf
                        @foreach($locales as $locale)
                            <div class="col-md-12 mb-3">
                                <label for="title_{{$locale->code}}">{{ __('content.question') }}
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
                                <textarea class="form-control" id="text_{{$locale->code}}"
                                          name="text[{{$locale->code}}]"
                                          rows="3">{{old("text['.$locale->code.']")}}</textarea>
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
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="navs-top-home">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-12 mb-3">
                                            <label for="image">{{ __('validation.attributes.image') }}</label>
                                            <input type="file" class="form-control" id="image"
                                                   name="image" value="{{ old('image') }}"
                                                   accept="image/png, image/gif, image/jpeg, image/heic, image/svg">
                                            @if($errors->has('image'))
                                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                        @foreach($locales as $locale)
                                            <div class="col-12 mb-2">
                                                <label for="image_title{{$locale->code}}">{{ __('content.image_title') }} ({{$locale->name}})</label>
                                                <input type="text" class="form-control" id="image_title{{$locale->code}}"
                                                       name="image_title[{{$locale->code}}]" value="{{ old('image_title['.$locale->code.']') }}">
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
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="type">{{ __('validation.attributes.type') }}</label>
                        <select class="form-control" id="type" name="type" required>
                            <option selected disabled>{{ __('form.choose') }} {{ __('validation.attributes.type') }}</option>
                            @foreach($types as $type)
                                <option value="{{$type->value}}" @selected(old('type') == $type->value)>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type'))
                            <div class="text-danger">{{ $errors->first('type') }}</div>
                        @endif
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
                <div class="card-body" id="options_block"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group text-center ">
                <a href="{{ route('polls.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                <button class="btn btn-info">{{ __('form.add') }}</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            const types = $("#type");
            let type = null;

            const radioBlock = `<div class="card shadow-1 type_block radio_block mb-2">
                        <div class="card-header">
                            <h4 class="card-header-title"><span class="option_counter">1</span> @lang('content.option')</h4>
                            <div class="card-header-btn">
                                <div class="collapse_btn btn btn-info"><i class="ion-ios-arrow-down"></i></div>
                                <div class="delete_btn btn btn-danger"><i class="ion-ios-trash-outline"></i></div>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="form-row">
                                @foreach($locales as $locale)
            <div class="col-6">
                <label for="option_title_{{$locale->code}}">{{ __('content.option') }}
            ({{$locale->name}})</label>
                                        <input type="text" class="form-control option_title" id="option_title_{{$locale->code}}"
                                               name="option_title[][{{$locale->code}}]" required
                                               value="{{ old('option_title['.$locale->code.']') }}">
                                        @if($errors->has('option_title['.$locale->code.']'))
            <div
                class="text-danger">{{ $errors->first('option_title['.$locale->code.']') }}</div>
                                        @endif
            </div>
@endforeach
            </div>
        </div>
    </div>`

            const multipleBlock = `<div class="card shadow-1 type_block multiple_block mb-2">
                        <div class="card-header">
                            <h4 class="card-header-title"><span class="option_counter">1</span> @lang('content.option')</h4>
                            <div class="card-header-btn">
                                <div class="collapse_btn btn btn-info"><i class="ion-ios-arrow-down"></i></div>
                                <div class="delete_btn btn btn-danger"><i class="ion-ios-trash-outline"></i></div>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="form-row">
                                @foreach($locales as $locale)
            <div class="col-6">
                <label for="option_title_{{$locale->code}}">{{ __('content.option') }}
            ({{$locale->name}})</label>
                                        <input type="text" class="form-control option_title" id="option_title_{{$locale->code}}"
                                               name="option_title[1][{{$locale->code}}]" required
                                               value="{{ old('option_title['.$locale->code.']') }}">
                                        @if($errors->has('option_title['.$locale->code.']'))
            <div
                class="text-danger">{{ $errors->first('option_title['.$locale->code.']') }}</div>
                                        @endif
            </div>
@endforeach
            </div>
        </div>
    </div>`

            const textBlock = `<div class="card shadow-1 type_block text_block mb-2">
                        <div class="card-header">
                            <h4 class="card-header-title">@lang('content.option')</h4>
                        </div>
                        <div class="card-body collapse show">
                            <p>Text tipida ishtirokchining javobi yozma tarzda kiritiladi. Variantlar bo'lmaydi !!!?</p>
                        </div>
                    </div>`;
            const imageBlock = `<div class="card shadow-1 type_block image_block mb-2">
                        <div class="card-header">
                            <h4 class="card-header-title"><span class="option_counter">1</span> @lang('content.option')</h4>
                            <div class="card-header-btn">
                                <div class="collapse_btn btn btn-info"><i class="ion-ios-arrow-down"></i></div>
                                <a href="javascript:void(0)" data-toggle="remove" class="btn btn-danger"><i class="ion-ios-trash-outline"></i></a>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="option_image">{{ __('validation.attributes.image') }}</label>
                                    <input type="file" class="form-control" id="option_image" required
                                           name="option_image[]" value="{{ old('option_image') }}"
                                           accept="image/png, image/gif, image/jpeg, image/heic, image/svg">
                                    @if($errors->has('option_image'))
            <div class="text-danger">{{ $errors->first('option_image') }}</div>
                                    @endif
            </div>
@foreach($locales as $locale)
            <div class="col-6">
                <label for="option_image_title_{{$locale->code}}">{{ __('content.option') }}
            ({{$locale->name}})</label>
                                        <input type="text" class="form-control option_title" id="option_image_title_{{$locale->code}}"
                                               name="option_image_title[1][{{$locale->code}}]"
                                               value="{{ old('option_image_title['.$locale->code.']') }}">
                                        @if($errors->has('option_image_title['.$locale->code.']'))
            <div
                class="text-danger">{{ $errors->first('option_image_title['.$locale->code.']') }}</div>
                                        @endif
            </div>
@endforeach
            </div>
        </div>
    </div>`

            const addBtn = $('#add_option');
            const optionsBlock = $('#options_block');
            types.on('change', function () {
                type = $(this).val();
                $('.type_block').remove();
                switch (type) {
                    case "image" :
                        optionsBlock.append(imageBlock);
                        addBtn.show()
                        break
                    case "text" :
                        optionsBlock.append(textBlock);
                        addBtn.hide()
                        break;
                    case "radio" :
                        optionsBlock.append(radioBlock);
                        addBtn.show()
                        break;
                    case "multiple" :
                        optionsBlock.append(multipleBlock);
                        addBtn.show()
                        break
                }
            })

            addBtn.click(function () {
                if (type && type !== 'text') {
                    const cloneElement = $("." + type + "_block" + ":last").clone(true);
                    const count = cloneElement.find('.option_counter').text() * 1
                    cloneElement.find('.option_counter').text(count + 1);
                    cloneElement.find('.option_title').each(function () {
                        let name = $(this).attr('name');
                        let newName = name.replace(/\[\d+\]/, `[${count + 1}]`);
                        $(this).attr('name', newName);
                    });
                    cloneElement.find('.option_image_title').each(function () {
                        let name = $(this).attr('name');
                        let newName = name.replace(/\[\d+\]/, `[${count + 1}]`);
                        $(this).attr('name', newName);
                    })
                    $('#options_block').append(cloneElement);
                }
            })

            $(document).on('click', '.collapse_btn',function () {
                $(this).closest('.type_block').children('.card-body').toggleClass('show');
            })

            $(document).on('click', '.delete_btn', function () {
                if($('.type_block').length > 1) {
                    $(this).closest('.type_block').remove();
                }
                $('.type_block').each(function (i = 0){
                    $(this).find('.option_counter').html(i+1);
                })
            });
        });
    </script>
@endsection
