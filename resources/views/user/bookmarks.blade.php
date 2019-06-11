@extends('layouts.app')

@section('content')

    {{-- main bookmarks section --}}
    <h2>My List</h2>

    @foreach($bookmarks as $bookmark)
        @include('partials.review_card_1',['review'=>$bookmark])
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



