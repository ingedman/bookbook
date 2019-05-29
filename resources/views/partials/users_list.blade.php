<ul class="list-group">
    @foreach($users as $user)
        <li href="#" class="list-group-item">
            <a  href="{{ route('user.profile',$user->{'id'}) }}"
                class="d-flex justify-content-between no-underline"

            >
                <div class="d-flex">
                    <div class=""
                         style="width: 40px;height: 40px;overflow: hidden;"
                    >
                            <img class="rounded-circle" src="{{ $user->{'avatarUrl'} }}" width="40" alt="profile picture">
                        </div>

                    <div class="pl-3">{{ $user->{'name'} }}</div>
                </div>
                <div class="">
                    <follow-button url="{{route('user.follow', $user->{'id'})}}"
                                   :already="{{json_encode($user->{'followed'})}}"
                                   id="{{ $user->{'id'} }}"></follow-button>
                </div>

            </a>
        </li>
    @endforeach
</ul>

