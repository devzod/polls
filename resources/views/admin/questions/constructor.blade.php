@extends('layouts.main')
@section('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection
@section('content')
    <div class="row clearfix" id="app"></div>
@endsection
