@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- main feed section --}}
            <div class="col-md-8">

                @for($i=0;$i<5;$i++)
                    <div class="media pt-2">
                        <a href="#link-to-reviewer" class="rounded-circle"><img src="{{ asset('img/man.jpg') }}" width="60" class="mr-3 rounded-circle " alt="..."></a>
                        <div class="media-body">

                            <div class="card" >
                                <div class="card-body position-relative">
                                    <a href="#link-to-review" class="stretched-link"></a>
                                    <div class="mb-2">
                                        <h5 class="my-0">Five things I love about War and Peace</h5>
                                        <small class="text-muted">About <strong>War an Peace</strong></small>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias ea eius facere
                                        laudantium
                                        odio
                                        quaerat quas saepe tempore? Amet animi asperiores at dolores enim excepturi omnis
                                        quam quo
                                        rem
                                        sapiente?</p>
                                </div>
                                <div class="actions card-body py-0">
                                    {{-- Actions section --}}
                                    <div class="row">
                                        <div class="col  d-flex flex-column align-items-center">
                                            <div class="font-weight-bold">702k</div>
                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                    title="Like">
                                                <i class="far fa-thumbs-up line-height-initial"></i>
                                            </button>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center">
                                            <div class="font-weight-bold">500</div>
                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                    title="Dislike">
                                                <i class="far fa-thumbs-down line-height-initial"></i>
                                            </button>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center">
                                            <div class="font-weight-bold">500</div>
                                            <a href="{{route('review')}}#comments" class="btn" data-toggle="tooltip" data-placement="bottom"
                                               title="Comments">
                                                <i class="far fa-comment line-height-initial"></i>
                                            </a>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-end hidden-sm-down">
                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                    title="Share">
                                                <i class="fas fa-share-alt line-height-initial"></i>
                                            </button>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-end hidden-md-down">
                                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                    title="Read later">
                                                <i class="far fa-bookmark line-height-initial"></i>
                                            </button>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-end">
                                            <div class="btn-group dropdown">
                                                <button class="btn focus-shadow-0 focus-outline-0" type="button"
                                                        id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h  line-height-initial "></i>

                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                     aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item hidden-md-up" href="#">share</a>
                                                    <a class="dropdown-item hidden-lg-up" href="#">Read later</a>
                                                    <a class="dropdown-item" href="#">Report</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End of Actions section --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            {{-- End of main feed section --}}


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


