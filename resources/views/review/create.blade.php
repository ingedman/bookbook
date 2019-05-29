@extends('layouts.app')

@section('content')

    <the-editor  save_url="{{$save_url}}"
                 initial_content="{{$review->{'pureContent'} ?? '' }}"
                 initial_title="{{$review->{'title'} ?? '' }}"
                 :initial_book="{{$book ?? 'null' }}"
    ></the-editor>

@endsection