@extends('layout.app')


@section('content')
    @foreach ($monHoc as $mh)
        <h1>{{ $mh['tenmon'] }}</h1>
    @endforeach
@endsection
