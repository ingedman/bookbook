@extends('layouts.app')

@section('content')
    <div class="border-bottom border-primary">
        {{-- profile header --}}
        <div class="row">
            <div class="col  justify-content-start flex-grow-0 d-inline-block">
                <img class="rounded-circle" src="{{ asset('img/man.jpg') }}" width="120" alt="profile picture">
            </div>
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="profile-name mb-2">Eslam Fakhry</h3>
                <div class="">

                    <a href="{{route('settings')}}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
        {{-- End of profile header --}}

        {{-- Bio section --}}
        <div class="row mb-3">
            <h2 class="pt-4 col">Bio</h2>
            <div class="w-100"></div>
            <p class="col-md-9 col-lg-7">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi, aut
                consequuntur eaque, error esse
                exercitationem expedita id labore necessitatibus nesciunt nihil officia praesentium quae, quibusdam
                reprehenderit sed temporibus voluptas.</p>

        </div>
        {{-- End of Bio section --}}

        {{-- Actions section --}}
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <div>followers</div>
                <div class=" py-1">708k</div>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div>following</div>
                <div class=" py-1">500</div>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div>reviews</div>
                <div class=" py-1">15</div>
            </div>
        </div>

        {{-- End of Actions section --}}
    </div>
    {{-- reviews section --}}
    <div class="container ">
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h3 class="">Reviews</h3>
            <a href="#" class="btn btn-primary">New review</a>
        </div>
        <div class="pt-3">
            <div class="row">
                @for($i=0;$i<3;$i++)
                    <div class="col-md-6 d-flex">
                        <div class="card flex-grow-1">
                            <div class="card-body ">
                                <div class="d-flex justify-content-between align-items-center"><h5
                                            class="card-title mb-0">Card title</h5>
                                    <small class="text-muted">5 months ago</small>
                                </div>
                                <small class="text-muted">About <strong>War and Peace</strong></small>
                                <p class="card-text mt-2">Some quick example text .</p>
                            </div>
                            <div class="card-body pb-0 flex-grow-0">
                                <div class="row">
                                    <div class="col d-flex flex-column align-items-center">
                                        <div>708k</div>
                                        <div class="py-1">
                                            <i class="far fa-thumbs-up line-height-initial "></i>
                                        </div>

                                    </div>
                                    <div class="col d-flex flex-column align-items-center">
                                        <div>708k</div>
                                        <div class="py-1">
                                            <i class="far fa-thumbs-down line-height-initial "></i>
                                        </div>

                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end">
                                        <div>500</div>
                                        <div class="py-1">
                                            <i class="far fa-comment line-height-initial"></i>
                                        </div>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end">
                                        <div class="py-1">
                                            <i class="fas fa-share-alt line-height-initial"></i>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                @endfor


            </div>

        </div>

    </div>
    {{-- End of reviews section --}}
@endsection
