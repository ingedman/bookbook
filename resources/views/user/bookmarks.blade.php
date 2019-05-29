@extends('layouts.app')

@section('content')

    {{-- main bookmarks section --}}
    <h2>My List</h2>

    @foreach($bookmarks as $bookmark)
        <div class="media border-bottom border-primary pt-4">
            <a href="{{ route('user.profile',$bookmark->reviewer->{'id'})}}" class="rounded-circle"><img src="{{ $bookmark->reviewer->{'avatarUrl'} }}" width="60" class="mr-3 rounded-circle " alt="reviewer avatar"></a>
            <div class="media-body">
                <div class="position-relative">
                    <a href="{{route('review',$bookmark->{'slug'} )}}" class="stretched-link"></a>
                    <h5 class="mt-0">{{$bookmark->{'title'} }}</h5>
                    <p>{!! $bookmark->{'preview'} !!}</p>
                </div>
                {{-- Actions section --}}
                <review-card-controls index="{{$bookmark->{'id'} }}" :review="{{$bookmark->{'controlsJson'} }}"></review-card-controls>
                {{-- End of Actions section --}}
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center my-4">
        {{ $bookmarks->links() }}
    </div>
    {{-- End of main bookmarks section --}}
    

@endsection

@section('aside')
    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection



