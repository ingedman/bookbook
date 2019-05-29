@extends('layouts.app')

@section('content')

    {{-- main feed section --}}



    @foreach($feed as $feedItem)


        <div class="card">
            <div class="card-header d-flex ">
                <a href="{{ route('user.profile',$feedItem->reviewer->id)}}"
                   class="flex-shrink-0"
                   style="width: 40px; overflow: hidden"
                >
                    <img src="{{ $feedItem->reviewer->{'avatarUrl'} }}"
                         width="40"
                         height="40"
                         class="mr-3 rounded-circle "
                         alt="reviewer avatar">
                </a>
                <div class="d-flex flex-column justify-content-center pl-2">
                    <a href="{{route('user.profile',$feedItem->reviewer->id)}}" class="no-underline">
                        <div class="mt-0 mb-0">{{$feedItem->reviewer->name}}</div>
                    </a>
                    <a href="{{route('review',$feedItem->slug)}}" class="no-underline">
                        <h5 class="mt-0 mb-0">{{$feedItem->title}}</h5>
                    </a>
                </div>
            </div>

            <div class="card-body pb-0 pt-1">
                <small class="ml-2 text-muted">About <a
                            href="{{ route('book',$feedItem->book->slug)}}"><strong>{{$feedItem->book->title}}</strong></a>
                </small>
            </div>
            <div class="card-body py-2">
                <a href="{{route('review',$feedItem->slug)}}" class="no-underline">

                    <p>{!! $feedItem->preview !!}</p>
                </a>
            </div>
            <div class="card-footer">
                {{-- Actions section --}}
                <review-card-controls index="{{$feedItem->id}}"
                                      :review="{{$feedItem->controlsJson}}"
                ></review-card-controls>
                {{-- End of Actions section --}}

            </div>
        </div>




        {{--<div class="media border-bottom border-primary pt-4">--}}

            {{--<div class="media-body">--}}
                {{--<div class="position-relative">--}}





                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}



        {{--<div class="media border-bottom border-primary pt-4">
            <a href="{{ route('user.profile',$feedItem->reviewer->id)}}"
               class="rounded-circle"
               style="width: 60px;overflow: hidden"
            >
                <img src="{{ $feedItem->reviewer->{'avatarUrl'} }}"
                     width="60"
                     class="mr-3 rounded-circle "
                     alt="reviewer avatar">
            </a>
            <div class="media-body">
                <div class="position-relative">
                    <a href="{{route('review',$feedItem->slug)}}" class="no-underline">
                        <h5 class="mt-0 mb-0">{{$feedItem->title}}</h5>
                    </a>

                    <small class="ml-2 text-muted">About <a
                                href="{{ route('book',$feedItem->book->slug)}}"><strong>{{$feedItem->book->title}}</strong></a>
                    </small>
                    <a href="{{route('review',$feedItem->slug)}}" class="no-underline">

                        <p>{!! $feedItem->preview !!}</p>
                    </a>

                </div>
                --}}{{-- Actions section --}}{{--
                <review-card-controls index="{{$feedItem->id}}"
                                      :review="{{$feedItem->controlsJson}}"></review-card-controls>
                --}}{{-- End of Actions section --}}{{--
            </div>
        </div>--}}


    @endforeach
    <div class="d-flex justify-content-center my-4">
        {{ $feed->links() }}
    </div>
    {{-- End of main feed section --}}
@endsection


@section('aside')

    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection






