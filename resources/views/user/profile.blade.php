@extends('layouts.app')

@section('content')
    <div class="border-bottom border-primary">
        {{-- profile header --}}
        <div class="row">
            <div class="col  justify-content-start flex-grow-0 d-inline-block">
                <img class="rounded-circle" src="{{ $user->{'avatarUrl'} }}" width="120"
                     alt="profile picture of {{ $user->{'name'} }}">
            </div>
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="profile-name mb-2">{{ $user->{'name'} }}</h3>
                <div class="">
                    @if(Auth::user()->is($user) )


                        <a href="{{route('settings')}}" class="btn btn-primary">Edit Profile</a>
                    @else
                        <follow-button
                                url="{{route('user.follow', $user->{'id'})}}"
                                :already="@json($user->{'followed'})"
                        ></follow-button>
                    @endif

                </div>
            </div>
        </div>
        {{-- End of profile header --}}

        {{-- Bio section --}}
        <div class="row mb-3">
            <h2 class="pt-4 col">Bio</h2>
            <div class="w-100"></div>
            <p class="col-md-9 col-lg-7">{{ $user->bio }}</p>
        </div>
        {{-- End of Bio section --}}

        {{-- Actions section --}}
        <user-card-controls index="{{$user->id}}" :user="{{$user->controlsJson}}"></user-card-controls>
        {{-- End of Actions section --}}

    </div>
    {{-- reviews section --}}
    <div class="container ">
        @if(Auth::user()->is($user) )


            <div class="d-flex justify-content-between align-items-center mt-5">
                <h3 class="">Reviews</h3>
                <a href="{{route('review.create')}}" class="btn btn-primary">New review</a>
            </div>
        @else



            <h3 class="mt-5">Reviews</h3>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group mt-2">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <span>order by</span>
                        <span>

                        @switch(request('sort'))
                                @case('popular')
                                popularity
                                @break

                                @case('title')
                                title
                                @break

                                @default
                                date
                            @endswitch
                        </span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                           href="{{ route(Route::currentRouteName() , ['id'=>$user->{'id'},'sort'=>'created_at','page'=>request('page')]) }}">date</a>
                        <a class="dropdown-item"
                           href="{{ route(Route::currentRouteName() , ['id'=>$user->{'id'},'sort'=>'popular','page'=>request('page')]) }}">popularity</a>
                        <a class="dropdown-item"
                           href="{{ route(Route::currentRouteName() , ['id'=>$user->{'id'},'sort'=>'title','page'=>request('page')]) }}">title</a>

                    </div>
                </div>
                {{--<a href="#" class="btn btn-link">show all</a>--}}

            </div>
        @endif


        <div class="pt-3">
            @forelse($reviews as $review)
                <div class=" d-flex">
                    <div class="card flex-grow-1">
                        <div class="card-body ">
                            <a class="no-underline" href="{{route('review',$review->{'slug'})}}">
                                <h5 class="card-title mb-0">{{$review->title}}</h5>
                            </a>

                            <small class="ml-2 text-muted">About <a
                                        href="{{route('book',$review->book->slug)}}"><strong>{{$review->book->title}}</strong></a>
                            </small>
                            <a class="no-underline" href="{{route('review',$review->{'slug'})}}">
                                <p class="card-text mt-2">{!! $review->{'preview'} !!}</p>
                            </a>

                        </div>
                        <div class="card-body pb-0 flex-grow-0">
                            {{-- Actions section --}}
                            <review-card-controls index="{{$review->id}}"
                                                  :review="{{$review->controlsJson}}"></review-card-controls>
                            {{-- End of Actions section --}}

                        </div>
                    </div>
                </div>
            @empty
                @if(Auth::user()->is($user))
                    You do not have any reviews.
                @else
                    {{ $user->{'name'} }} has no reviews yet.

                @endif
            @endforelse
            <div class="d-flex justify-content-center my-4">
                {{ $reviews->links() }}
            </div>


            {{--<test-component :user="{{$user}}"></test-component>--}}
        </div>
    </div>
    {{-- End of reviews section --}}
@endsection

@section('aside')

    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection


