@extends('layouts.main')
@section('css')
    @vite('resources/js/app.js')
    @inertiaHead
@endsection
@section('content')
    @inertia
@endsection
