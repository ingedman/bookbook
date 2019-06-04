<div class="row mb-4 mt-3">
    <div class="col pr-0   justify-content-start flex-grow-0 d-inline-block">
        <a class="rounded-circle no-underline" href="{{route('user.profile',$user->{'id'})}}"><img
                    class="rounded-circle" src="{{ $user->{'avatarUrl'} }}" width="60"
                    alt="profile picture"></a>
    </div>
    <div class="col d-flex flex-column justify-content-center">
        <a class="no-underline" href="{{route('user.profile',$user->{'id'})}}"><h6 class="profile-name mb-1">{{ $user->{'name'} }}</h6></a>
            @if(Auth::user()->isNot($user) )


            <div class="">
                <follow-button url="{{route('user.follow', $user->{'id'})}}"
                               :already="@json($user->{'followed'} )"></follow-button>
            </div>
            @endif

    </div>
</div>