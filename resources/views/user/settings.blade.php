@extends('layouts.app')

@section('content')
    {{-- profile picture --}}
    <div class="d-flex flex-column align-items-center mb-3">

        <img class="rounded-circle mx-auto mb-2" src="{{ asset('img/man.jpg') }}" width="120" alt="profile picture">
        <div class="btn btn-outline-primary py-0">upload</div>
    </div>
    {{-- End of profile picture --}}

    {{-- settings options --}}
    <div class="settings-options">
        {{-- single settings option --}}
        <div class="row  my-3">
            <div class="col flex-grow-1 settings-option-detail ">
                <div class="row ">
                    <div class=" col-md-3 col-lg-2"><p class="h5 text-md-right">Full Name:</p></div>
                    <div class="col-sm"><p>Eslam Fakhry</p></div>
                </div>
            </div>
            <div class="col flex-grow-0 settings-option-action"><a href="#" role="button"><i
                            class="fas fa-edit"></i></a></div>
        </div>
        {{-- End of single settings option --}}



        {{-- single settings option --}}
        <div class="row  my-3">
            <div class="col flex-grow-1 settings-option-detail ">
                <div class="row ">
                    <div class=" col-md-3 col-lg-2"><p class="h5 text-md-right">Username:</p></div>
                    <div class="col-sm"><p>eslamfakhry</p></div>
                </div>
            </div>
            <div class="col flex-grow-0 settings-option-action"><a href="#" role="button"><i
                            class="fas fa-edit"></i></a></div>
        </div>
        {{-- End of single settings option --}}

        <settings-option label="Username:" :initial_items_list="['eslamfakhry']"></settings-option>
        <settings-option label="Username:" :initial_items_list="['eslamfakhry','google']"></settings-option>

        {{-- single settings option --}}
        <div class="row  my-3">
            <div class="col flex-grow-1 settings-option-detail ">
                <div class="row ">
                    <div class=" col-md-3 col-lg-2"><p class="h5 text-md-right">Email:</p></div>
                    <div class="col-sm"><p>eslam@fakhry.me</p></div>
                </div>
            </div>
            <div class="col flex-grow-0 settings-option-action"><a href="#" role="button"><i
                            class="fas fa-edit"></i></a></div>
        </div>
        {{-- End of single settings option --}}

        {{-- single settings option --}}
        <div class="row  my-3">
            <div class="col flex-grow-1 settings-option-detail ">
                <div class="row ">
                    <div class=" col-md-3 col-lg-2"><p class="h5 text-md-right">Bio:</p></div>
                    <div class="col-sm"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam,
                            asperiores atque commodi culpa delectus dolorum eligendi eveniet, facilis incidunt
                            libero mollitia nemo, odit omnis qui quidem repellat repellendus vel velit?</p></div>
                </div>
            </div>
            <div class="col flex-grow-0 settings-option-action"><a href="#" role="button"><i
                            class="fas fa-edit"></i></a></div>
        </div>
        {{-- End of single settings option --}}

        {{-- single settings option --}}
        <div class="row  my-3 ">
            <div class="col flex-grow-1 settings-option-detail ">
                <div class="row">
                    <div class=" col-md-3 col-lg-2"><p class="h5 text-md-right">Languages:</p></div>
                    <div class="col-sm">
                        <div class="">Arabic
                            <small>
                                <div class="badge badge-pill badge-primary pl-1">primary</div>
                            </small>
                        </div>
                        <div class="">English</div>
                        <div class="">Spanish</div>
                    </div>
                </div>
            </div>
            <div class="col flex-grow-0 settings-option-action">
                <a href="#" role="button"><i class="fas fa-edit"></i></a>
            </div>
        </div>
        {{-- End of single settings option --}}

        {{-- single settings option --}}
        <div class="row  my-3">
            <div class="col flex-grow-1 settings-option-detail ">
                <div class="row align-items-center">
                    <div class=" col-md-3 col-lg-2"><a href="#" class="btn btn-danger">Delete account</a></div>
                </div>
            </div>
        </div>
        {{-- End of single settings option --}}

    </div>
    {{-- End of settings options --}}
@endsection
