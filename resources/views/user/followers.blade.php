@extends('layouts.app')

@section('content')
    @include('partials.users_list',compact('users'))
    @if(count($users)===0)
        {{ $emptyMsg }}
    @endif
    <div class="d-flex justify-content-center my-4">

        {{ $users->links() }}
    </div>
@endsection


@section('aside')

    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection


