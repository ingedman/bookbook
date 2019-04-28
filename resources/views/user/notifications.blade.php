@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- main notifications section --}}
            <div class="col-md-8">

                <h2>Notifications</h2>

                @for($i=0;$i<5;$i++)
                {{-- single notification --}}
                <div class="media border-bottom border-primary py-1">
                    <img src="{{ asset('img/man.jpg') }}" width="30" class="mr-3 rounded-circle " alt="user profile picture">
                    <div class="media-body">
                        <h5 class="mt-0">someone commented on you review no. {{$i}}</h5>
                        <p class="mb-0">2 days ago</p>
                    </div>
                </div>
                {{-- End of single notification --}}
                @endfor






            </div>

            {{-- End of main notifications section --}}


            {{-- aside section --}}
            <div class="col-md-4 hidden-sm-down">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>

            {{-- End of aside section --}}


        </div>
    </div>
@endsection


