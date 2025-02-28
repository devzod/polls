@extends('layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <div class="card-header-title">
                        <h5>{{$poll->title}}</h5>
                    </div>
                    @can('questions.store')
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#m_modal_1">
                            <i class="fa fa-plus button-2x"> {{ __('form.add') }} {{ __('content.question') }}</i>
                        </button>
                    @endcan
                </div>
                <div class="card-body collapse show" id="collapse2">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <form action="?" method="get" id="paginate" >
                                <td>
                                    <select class="form-control select2 select2-hidden-accessible" name="limit"
                                            style="width: 65px" onchange="$('#paginate').submit()">
                                        <option value="10" @selected(request('limit') == 10)>10</option>
                                        <option
                                            value="15" @selected(request('limit') == 15 || is_null(request('limit')))>15
                                        </option>
                                        <option value="20" @selected(request('limit') == 20)>20</option>
                                        <option value="30" @selected(request('limit') == 30)>30</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="search"
                                           placeholder="{{ __('content.question') }} ..."
                                           value="{{ request('search') }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="text" placeholder="{{ __('validation.attributes.description') }} ..." value="{{ request('text') }}">
                                </td>
                                <td>
                                    <select class="form-control w-auto" id="type" name="type">
                                        <option value="" selected disabled>{{ __('form.choose') }} {{ __('validation.attributes.type') }}</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->value}}" @selected(request('type') == $type->value)>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control w-auto" id="status" name="status">
                                        <option value="" selected disabled>{{ __('form.choose') }} {{ __('validation.attributes.status') }}</option>
                                        <option value="1" @selected(request('status') == 1)>{{ trans('content.active') }}</option>
                                        <option value="0" @selected(request()->filled('status') && request('status') == 0)>{{ trans('content.disabled') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="row">
                                        <button class="btn btn-primary me-2"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('polls.questions', $poll->id) }}" class="btn btn-outline-info"><i class="fa fa-refresh"></i></a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('content.question') }}</th>
                            <th>{{ __('validation.attributes.description') }}</th>
                            <th class="text-center">{{ __('validation.attributes.image') }}</th>
                            <th>{{ __('validation.attributes.type') }}</th>
                            <th>{{ __('validation.attributes.status') }}</th>
                            <th>{{ __('form.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{$item->text}}</td>
                                <td class="text-center">
                                    @if($item->image)
                                        <img class="img-thumbnail" src="{{asset('/storage/'.$item->image)}}" width="100" alt="{{$item->imageTitle}}">
                                        @if($item->imageTitle) <p >{{$item->imageTitle}}</p> @endif
                                    @endif
                                </td>
                                <td class="text-uppercase"><b>{{$item->type}}</b></td>
                                <td><span class="badge badge-pill {{$item->active_class}}">{{ $item->active_text }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route("questions.show", [$item->id]) }}"><i class="fa fa-eye text-purple button-2x"></i></a>
                                        @can('questions.update')
                                            <a class="mg-x-10" href="{{ route("questions.edit", [$item->id]) }}">
                                                <i class="fa fa-edit text-purple button-2x"></i></a>
                                        @endcan
                                        @can('questions.delete')
                                            <a href="{{ route("polls.removeQuestion", [$poll->id, $item->id]) }}" class=""
                                               onclick="return confirm(this.getAttribute('data-message'));"
                                               data-message="{{ __('table.confirm_delete') }}">
                                                <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                        @endcan
                                        @can('questions.store')
                                            <a class="ml-2 btn btn-outline-success" href="{{ route("questions.constructor", [$item->id]) }}">Constructor</a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="7" class="text-center">@lang('content.not_found')</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <nav class="d-flex justify-content-between">
                        <span>{{ __('form.showed') }}: <b>{{ $pagination->count() }}</b></span>
                        {{ $pagination->links('pagination::bootstrap-4') }}
                        <span>{{ __('form.total') }}: <b>{{ $pagination->total() }}</b></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="post" action="{{route('polls.addQuestion', $poll->id)}}">
                @csrf
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
                            <option value="{{$question->id}}">{{$question->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <a href="{{ route("questions.create", $poll->id) }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }} {{__('form.new')}} {{ __('content.question') }}</i></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('form.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('form.save')</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#questionTitle").keyup(function (){
                const title = $(this).val().toLowerCase();
                $('#selectBlock option').each(function () {
                    let optionText = $(this).text().toLowerCase();
                    if (optionText.includes(title.toLowerCase()) || title === "") {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@endsection
