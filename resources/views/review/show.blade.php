@extends('layouts.app')

@section('content')
    <div class="border-bottom border-primary">
        {{-- review section --}}
        <div class="">
            <h1 class="mb-0">{{$review->title}}</h1>
            <small class="text-muted">about <a
                        href="{{route('book',$review->book->slug)}}"><strong>{{$review->book->title}}</strong></a>
            </small>
        </div>
        @if(Auth::user()->isNot($review->{'reviewer'}) )

            @include('partials.user_profile_widget',['user'=> $review->{'reviewer'}])
        @endif

        <div class="review-content my-4">
            {!! $review->{'pureContent'} !!}
        </div>


        {{-- End of review section --}}

        {{-- Actions section --}}
        <review-card-controls index="{{$review->id}}" :review="{{$review->controlsJson}}"></review-card-controls>
        {{-- End of Actions section --}}

    </div>
    <div class="container">

        @if(Auth::user()->isNot($review->{'reviewer'}) )


            @include('partials.user_profile_widget',['user'=> $review->reviewer])



            {{-- related reviews --}}
            <h3 class="mt-5">You might like</h3>
            <div class="pt-3">
                <div class=" ">
                    @foreach($similarReviews as $similarReview)
                        <div class=" d-flex">
                            <div class="card flex-grow-1">
                                <div class="card-body ">
                                    <a class="no-underline" href="{{ route('review',$similarReview->{'slug'}) }}">
                                        <h5 class="card-title mb-0">{{$similarReview->title}}</h5>
                                    </a>
                                    <small class="ml-2 text-muted">About <a
                                                href="{{ route('book',$similarReview->book->slug)}}"><strong>{{$similarReview->book->title}}</strong></a>
                                    </small>
                                    <a class="no-underline" href="{{ route('review',$similarReview->{'slug'}) }}">
                                        <p class="card-text mt-2">{!! $similarReview->{'preview'} !!}</p>
                                    </a>
                                </div>
                                <div class="card-body pb-0 flex-grow-0">
                                    {{-- Actions section --}}
                                    <review-card-controls index="{{$similarReview->id}}"
                                                          :review="{{$similarReview->controlsJson}}"></review-card-controls>
                                    {{-- End of Actions section --}}

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            {{-- End of related reviews --}}
        @endif


        {{-- comment section --}}
        <h3 class="mt-5" id="comments">Comments</h3>
        <comments-section
                url="{{route('comments', $review->{'id'})}}"
                review_comment_url="{{route('review.comment', $review->{'slug'})}}"
                img_url="{{ Auth::user()->{'avatarUrl'} }}"
                review_id="{{ $review->{'id'} }}"
        ></comments-section>


    </div>
@endsection

@section('aside')

    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection
