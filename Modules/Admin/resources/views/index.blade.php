@extends('admin::layout.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('admin.name') !!}</p>
@endsection
