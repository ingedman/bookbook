@extends('layouts.app')

@section('content')

    {{-- main notifications section --}}
    <h2>Notifications</h2>



    @forelse($notifications as $notification)

        {{-- single notification --}}
        <notifications-item  :notification="{{ $notification }}"></notifications-item>

        {{-- End of single notification --}}
    @empty
        You have no notifications
    @endforelse
    <div class="d-flex justify-content-center my-4">
        {{ $notifications->links() }}
    </div>


    {{-- End of main notifications section --}}
@endsection

@section('aside')

    {{-- aside section --}}
    @include('partials.side_bar_recommendation',compact('recommendation'))
    {{-- End of aside section --}}
@endsection


