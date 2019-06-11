<div class="card mb-2">
    <div class="card-header d-flex ">
        <a href="{{ route('user.profile',$review->reviewer->id)}}"
           class="flex-shrink-0"
           style="width: 40px; overflow: hidden"
        >
            <img src="{{ $review->reviewer->{'avatarUrl'} }}"
                 width="40"
                 height="40"
                 class="mr-3 rounded-circle "
                 alt="reviewer avatar">
        </a>
        <div class="d-flex flex-column justify-content-center pl-2">
            <a href="{{route('user.profile',$review->reviewer->id)}}" class="no-underline">
                <div class="mt-0 mb-0">{{$review->reviewer->name}}</div>
            </a>
            <a href="{{route('review',$review->slug)}}" class="no-underline">
                <h5 class="mt-0 mb-0 font-weight-bold">{{$review->title}}</h5>
            </a>
        </div>
    </div>

    <div class="card-body pb-0 pt-1">
        <small class="ml-2 text-muted">About <a
                    href="{{ route('book',$review->book->slug)}}"><strong>{{$review->book->title}}</strong></a>
        </small>
    </div>
    <div class="card-body py-2">
        <a href="{{route('review',$review->slug)}}" class="no-underline">

            <p>{!! $review->preview !!}</p>
        </a>
    </div>
    <div class="card-footer">
        {{-- Actions section --}}
        <review-card-controls
                index="{{$review->id}}"
                :review="{{$review->controlsJson}}"
                @can('update',$review)
                :can_edit="true"
                @endcan
        ></review-card-controls>
        {{-- End of Actions section --}}

    </div>
</div>