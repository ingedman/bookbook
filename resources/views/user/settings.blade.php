@extends('layouts.app')

@section('content')
    {{-- profile picture --}}

        {{--<img class="rounded-circle mx-auto mb-2" src="{{ Auth::user()->{'avatarUrl'} }}" width="120" alt="profile picture">--}}
        {{--<div class="btn btn-outline-primary py-0">upload</div>--}}
        <upload-button img_url="{{ Auth::user()->{'avatarUrl'} }}" ></upload-button>
    {{-- End of profile picture --}}

    {{-- settings options --}}
    <div class="settings-options">

        {{--        {{ dd($settings ) }}--}}
        @foreach($settings as $settingsOption)
            @if($settingsOption['type'] === 'textarea')
                <textarea-option :option="{{json_encode($settingsOption) }}"></textarea-option>
            @elseif($settingsOption['type'] === 'select')
                {{--@dump($settingsOption)--}}
                <select-option :option="{{json_encode($settingsOption) }}"></select-option>
            @else
                <text-option :option="{{json_encode($settingsOption) }}"></text-option>

                {{--                <settings-option :option="{{ json_encode($settingsOption) }}"></settings-option>--}}
            @endif
        @endforeach

        {{-- single settings option --}}
        @include('partials.delete_user_button')
        {{-- End of single settings option --}}

    </div>
    {{-- End of settings options --}}
@endsection
