@extends('layouts.app')

@section('content')
    <div class=" border-bottom border-primary">
        {{-- profile header --}}
        <div class="row pb-4">
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="profile-name mb-2">{{ $author->{'name'} }}</h3>
            </div>
        </div>
        {{-- End of profile header --}}

        {{-- Actions section --}}
        <author-card-controls :author="{{$author->{'controlsJson'} }}"
                              index="{{ $author->{'id'} }}"></author-card-controls>
        {{-- End of Actions section --}}
    </div>

    {{-- books section --}}
    <div class="container min-vh-100">
        <h3 class="mt-5">Books</h3>
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
                       href="{{ route(Route::currentRouteName() , ['id'=>$author->{'id'},'sort'=>'created_at','page'=>request('page')]) }}"
                    >date</a>
                    <a class="dropdown-item"
                       href="{{ route(Route::currentRouteName() , ['id'=>$author->{'id'},'sort'=>'popular','page'=>request('page')]) }}"
                    >popularity</a>
                    <a class="dropdown-item"
                       href="{{ route(Route::currentRouteName() , ['id'=>$author->{'id'},'sort'=>'title','page'=>request('page')]) }}"
                    >title</a>
                </div>
            </div>
            {{--<a href="#" class="btn btn-link">show all</a>--}}
        </div>
        <div class="pt-3">
            <div class="">
                @forelse($books as $book)
                    {{-- single book card --}}
                    <div class="d-flex">
                        <div class="card flex-grow-1">
                            <div class="card-body ">
                                <a href="{{ route('book', $book->{'slug'}) }}" class="no-underline">
                                    <h5 class="card-title mb-3">{{ $book->{'title'} }}</h5>
                                </a>
                                <div class="row">
                                    <div class="col-6 d-flex  justify-content-center  align-items-center flex-grow-0 d-inline-block">
                                        <a href="{{ route('book', $book->{'slug'}) }}" class="no-underline">
                                            <img class="" src="{{ $book->{'coverUrl'} }}" width="144" alt="book cover">
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <div class="py-2">
                                            <div class=" font-weight-bold">

                                                <div class=" font-weight-bold">
                                                    {{ Str::plural('Author', count($book->{'authors'} )) }}:
                                                </div>
                                            </div>
                                            @foreach($book->{'authors'} as $author)
                                                <div class="pl-4">
                                                    <a href="{{route('author',$author->{'id'})}}"
                                                       class="">{{$author->name}}</a>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class=" py-2">
                                            <div class=" font-weight-bold">Genre:</div>
                                            <div class=" pl-4 ">{{$book->{'genre'} }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body py-0 flex-grow-0">
                                {{-- book card actions --}}
                                <book-card-controls :book="{{$book->{'controlsJson'} }}"
                                                    index="{{$book->{'id'} }}"
                                ></book-card-controls>
                                {{-- End of book card actions --}}
                            </div>
                        </div>
                    </div>
                    {{-- End of single book card --}}
                @empty
                    This Author has no books.
                @endforelse
                <div class="d-flex justify-content-center my-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- End of books section --}}
@endsection

@section('aside')
    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection
