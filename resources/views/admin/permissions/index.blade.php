@extends('layouts.main')
@section('content')
    <div class="row clearfix @if(count($pagination->items()) <= 8) ht-100v @endif">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.permissions.permissions') }}
                    </h4>
                    {{--                    <div class="">--}}
                    @can('permissions.store')
                        <a href="{{ route("permissions.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                        {{--                    </div>--}}
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
                                    <input type="text" class="form-control" name="name"
                                           placeholder="{{ __('form.search') }}"
                                           value="{{ request('name') }}">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="row">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('permissions.index') }}" class="btn btn-outline-info"><i
                                                class="fa fa-refresh"></i></a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('validation.attributes.name') }}</th>
                            <th>{{ __('form.permissions.guard_name') }}</th>
                            <th>{{ __('validation.attributes.created_at') }}</th>
                            @canany(['permissions.update', 'permissions.delete'])
                                <th>{{ __('form.actions') }}</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->guard_name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @can('permissions.update')
                                        <a href="{{ route("permissions.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    @can('permissions.delete')
                                        <a href="{{ route("permissions.delete", [$item->id]) }}" class=""
                                           onclick="return confirm(this.getAttribute('data-message'));"
                                           data-message="{{ __('form.confirm_delete') }}">
                                            <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
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
