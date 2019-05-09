@extends('layouts.app')

@section('content')
    <div class="border-bottom border-primary">
        {{-- review section --}}
        <div class="mb-3">
            <h2 class="mb-0">{{$review->title}}</h2>
            <small class="text-muted">about <a href="{{route('book',$review->book->slug)}}"><strong>{{$review->book->title}}</strong></a>
            </small>
        </div>


        <user-profile-widget
                name="{{$review->reviewer->name}}"
                photo="{{ $review->reviewer->photo }}"
                url="{{route('user.follow', $review->reviewer->id)}}"
                :already="{{json_encode($review->reviewer->alreadyFollowed)}}"
        ></user-profile-widget>

        <p class="text-primary text-muted">{{ $review->content }}</p>
        <h3 class="">The plot is so great</h3>
        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Accusantium
            commodi, consectetur dolorem dolorum, ducimus eius eveniet explicabo hic id incidunt ipsa ipsum
            laudantium
            magni nam pariatur porro, quod ullam vero.</p>

        <h3 class="">Another section title</h3>
        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
            animi asperiores
            at atque culpa, dolorem, eos est facere harum impedit iste iusto labore mollitia non officiis
            omnis optio
            provident, quam quibusdam recusandae repudiandae similique suscipit tempore. Eligendi, esse
            nostrum. Ab
            adipisci alias animi architecto asperiores consequatur doloremque eligendi, esse eum excepturi
            expedita id
            impedit, in labore laboriosam, laborum minus non odio praesentium provident quam quibusdam
            quidem recusandae
            sed sit soluta velit voluptatem! Assumenda at delectus doloribus, iste modi perspiciatis
            suscipit!</p>

        <h3 class="">Another section title</h3>
        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem
            commodi
            cumque cupiditate in laborum quae reiciendis rerum tempore velit veniam.</p>

        {{-- End of review section --}}

        {{-- Actions section --}}
        <review-card-controls index="{{$review->id}}" :review="{{$review->controlsJson}}"></review-card-controls>
        {{-- End of Actions section --}}

    </div>
    <div class="container">

            <user-profile-widget
                    class="mt-3"
                    name="{{$review->reviewer->name}}"
                    photo="{{ $review->reviewer->photo }}"
                    url="{{route('user.follow', $review->reviewer->id)}}"
                    :already="{{json_encode($review->reviewer->alreadyFollowed)}}"
            ></user-profile-widget>

        {{-- related reviews --}}
        <h3 class="mt-5">You might like</h3>
        <div class="pt-3">
            <div class=" ">
                @foreach($similarReviews as $similarReview)
                    <div class=" d-flex">
                        <div class="card flex-grow-1">
                            <div class="card-body ">
                                <h5 class="card-title mb-0">{{$similarReview->title}}</h5>
                                <small class="text-muted">About <strong>War an Peace</strong></small>
                                <p class="card-text mt-2">{{Str::limit($similarReview->{'content'}, 200)}}</p>
                            </div>
                            <div class="card-body pb-0 flex-grow-0">
                                {{-- Actions section --}}
                                <review-card-controls index="{{$similarReview->id}}" :review="{{$similarReview->controlsJson}}"></review-card-controls>
                                {{-- End of Actions section --}}

                            </div>
                        </div>
                    </div>npm i @editorjs/editorjs --save-dev
                @endforeach
            </div>

        </div>
        {{-- End of related reviews --}}

        {{-- comment section --}}
        <h3 class="mt-5" id="comments">Comments</h3>
        <comments-section url="{{route('comments', $review->id)}}" ></comments-section>



    </div>
@endsection
