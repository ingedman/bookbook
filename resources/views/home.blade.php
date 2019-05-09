@extends('layouts.app')

@section('content')

            {{-- main feed section --}}

                @foreach($feed as $feedItem)
                    <div class="media border-bottom border-primary pt-4">
                        <a href="#link-to-reviewer" class="rounded-circle"><img src="{{ $feedItem->reviewer->photo}}" width="60" class="mr-3 rounded-circle " alt="..."></a>
                        <div class="media-body">
                            <div class="position-relative">
                                <a href="{{route('review',$feedItem->slug)}}" class="stretched-link"></a>
                                <h5 class="mt-0">{{$feedItem->title}}</h5>
                                <p>{{Str::limit($feedItem->content,200)}}</p>
                            </div>
                            {{-- Actions section --}}
                            <review-card-controls index="{{$feedItem->id}}" :review="{{$feedItem->controlsJson}}"></review-card-controls>
                            {{-- End of Actions section --}}
                        </div>
                    </div>
                @endforeach

            {{-- End of main feed section --}}
@endsection


@section('aside')

            {{-- aside section --}}
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>


            {{-- End of aside section --}}
@endsection





