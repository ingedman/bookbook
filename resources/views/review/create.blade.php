@extends('layouts.app')

@section('content')

    <the-editor
            save_url="{{$save_url}}"
            @if(old())

            initial_content="{{old('content')  ?? '' }}"
            initial_title="{{ old('title')  ?? '' }}"
            @else
            initial_content="{{ $review->{'pureContent'} ?? '' }}"
            initial_title="{{  $review->{'title'} ?? '' }}"
            @endif

            :initial_book="{{$book ?? 'null' }}"

            @if( isset($review))
            delete_review_url="{{ route('review.delete',$review->{'id'}) }}"
            @endif
            @if(session('errors'))
            :initial_errors="{{ json_encode(session('errors')) }}"
            @endif
            csrf="{{csrf_token()}}"

    ></the-editor>

@endsection