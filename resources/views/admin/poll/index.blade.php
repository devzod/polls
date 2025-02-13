@extends('layouts.main')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <div class="card-header-title">
                        <h5><a href="{{ route('poll.index') }}">{{ __('content.polls') }}</a></h5>
                    </div>
                    @can('poll.store')
                        <a href="{{ route("poll.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                    @endcan

                </div>
                <div class="card-body collapse show" id="collapse2">
                    <table class="table table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <form action="?" method="get" id="paginate">
                                <td>
                                    <select class="form-control select2 select2-hidden-accessible" name="limit"
                                            style="width: 65px" onchange="$('#paginate').submit()">
                                        <option value="5" @selected(request('limit') == 5)>5</option>
                                        <option
                                            value="10" @selected(request('limit') == 10 || is_null(request('limit')))>10
                                        </option>
                                        <option value="20" @selected(request('limit') == 20)>20</option>
                                        <option value="30" @selected(request('limit') == 30)>30</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="search"
                                           placeholder="{{ __('validation.attributes.name') }} ..."
                                           value="{{ request('search') }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="text"
                                           placeholder="{{ __('validation.attributes.description') }} ..."
                                           value="{{ request('text') }}">
                                </td>
                                <td colspan="2">
                                    <select class="form-control select2 select2-hidden-accessible w-auto" tabindex="-1" aria-hidden="true" id="status" name="status">
                                        <option value="" selected disabled>{{ __('form.choose') }} {{ __('validation.attributes.status') }}</option>
                                        <option value="1" @selected(request('status') == 1)>{{ trans('content.active') }}</option>
                                        <option value="0" @selected(request()->filled('status') && request('status') == 0)>{{ trans('content.disabled') }}</option>
                                    </select>
                                </td>
{{--                                <td colspan="2">--}}
{{--                                    <select class="form-control select2 select2-hidden-accessible" tabindex="-1"--}}
{{--                                            aria-hidden="true" id="region_id" name="region_id">--}}
{{--                                        <option value="" selected--}}
{{--                                                disabled>{{ __('form.region.region') }} {{ __('form.choose') }}</option>--}}
{{--                                        @foreach($regions as $region)--}}
{{--                                            <option--}}
{{--                                                value="{{ $region->id }}"--}}
{{--                                                @selected(request('region_id') == $region->id)--}}
{{--                                            >{{ $region->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </td>--}}
                                <td>
                                    <div class="row">
                                        <button class="btn btn-primary me-2"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('poll.index') }}" class="btn btn-outline-info"><i class="fa fa-refresh"></i></a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('validation.attributes.name') }}</th>
                            <th>{{ __('validation.attributes.description') }}</th>
                            <th>{{ __('validation.attributes.status') }}</th>
                            <th>{{ __('validation.attributes.date') }}</th>
                            <th>{{ __('form.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{$item->text}}</td>
                                <td><span class="badge badge-pill {{$item->active_class}}">{{ $item->active_text }}</span></td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{ route("poll.show", [$item->id]) }}"><i class="fa fa-eye text-purple button-2x"></i></a>
                                    @can('poll.update')
                                        <a href="{{ route("poll.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    @can('poll.delete')
                                        <a href="{{ route("poll.delete", [$item->id]) }}" class=""
                                           onclick="return confirm(this.getAttribute('data-message'));"
                                           data-message="{{ __('table.confirm_delete') }}">
                                            <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                    @endcan
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
@endsection
