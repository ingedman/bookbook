@extends('layouts.app')

@section('content')
    <div class="border-bottom border-primary">
        {{-- book info section --}}
        <h1>{{ $book->{'title'} }}</h1>
        <div class="row pb-2">
            <div class="col d-flex flex-grow-0  justify-content-center  align-items-center
             d-inline-block">
                <img class="" src="{{$book->{'coverUrl'} }}" width="144" alt="book cover">
            </div>
            <div class="col">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <th class="">{{ Str::plural('Author', count($book->authors)) }}</th>

                        <td>
                            @foreach($book->authors as $author)
                                <div><a href="{{route('author',$author->{'id'})}}" class="">{{$author->name}}</a></div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="">Year:</th>
                        <td>{{$book->year}}</td>
                    </tr>
                    <tr>
                        <th class="">Genre:</th>
                        <td>{{$book->genre}}</td>
                    </tr>
                    <tr>
                        <th class="">Languages:</th>
                        <td>
                            @foreach($book->languages as $language)
                                <div class="">{{$language->name}}</div>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- End of book info section --}}

        {{-- Actions section --}}
        <book-card-controls :book="{{$book->controlsJson}}" index="{{$book->id}}"></book-card-controls>
        {{-- End of Actions section --}}

    </div>

    {{-- reviews section --}}
    <div class="container">
        <h3 class="mt-5">Reviews</h3>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group mt-2">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
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
                       href="{{ route(Route::currentRouteName() , ['slug'=>$book->{'slug'},'sort'=>'created_at','page'=>request('page')]) }}"
                    >date</a>
                    <a class="dropdown-item"
                       href="{{ route(Route::currentRouteName() , ['slug'=>$book->{'slug'},'sort'=>'popular','page'=>request('page')]) }}"
                    >popularity</a>
                    <a class="dropdown-item"
                       href="{{ route(Route::currentRouteName() , ['slug'=>$book->{'slug'},'sort'=>'title','page'=>request('page')]) }}"
                    >title</a>

                </div>
            </div>
            {{--<a href="#" class="btn btn-link">show all</a>--}}
            <a href="{{route('review.create' , ['book'=>$book->{'slug'}])}}"
               class="btn btn-primary"
            >New review</a>


        </div>
        <div class="pt-3">
            <div class="">
                @forelse($reviews as $review)

                    {{-- single review card --}}
                        <div class="card mb-2">
                            <div class="card-body ">
                                <a class="no-underline" href="{{route('review',$review->{'slug'})}}">
                                    <h5 class="card-title mb-0">{{$review->title}}</h5>
                                </a>

                                <small class="text-muted">By
                                    <a href="{{route('user.profile',$review->reviewer->id)}}">
                                        <strong>{{$review->reviewer->name}}</strong>
                                    </a>
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


                    {{-- End of single review card --}}
                @empty
                    This book has no reviews yet. <a href="#">add review</a>
                @endforelse
                <div class="d-flex justify-content-center my-4">
                    {{ $reviews->links() }}
                </div>
            </div>

        </div>

    </div>
    {{-- End of reviews section --}}

@endsection

@section('aside')

    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection
