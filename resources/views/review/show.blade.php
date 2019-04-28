@extends('layouts.app')

@section('content')
    <div class="container border-bottom border-primary">
        {{-- review section --}}
        <div class="mb-3">
            <h2 class="mb-0">Why War and World is great</h2>
            <small class="text-muted">about <strong>War and World</strong></small>
        </div>

        {{--  poster info  --}}
        <div class="row mb-4">
            <div class="col pr-0  justify-content-start flex-grow-0 d-inline-block">
                <img class="rounded-circle" src="{{ asset('img/man.jpg') }}" width="60" alt="profile picture">
            </div>
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="profile-name mb-1">Eslam Fakhry</h3>
                <div class=""><a href="#"
                                 class="follow-btn btn btn-outline-success btn-sm px-2 py-0 mt-1 rounded-pill ">follow</a>
                </div>
            </div>
        </div>
        {{-- End of  poster info  --}}

        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium
            commodi, consectetur dolorem dolorum, ducimus eius eveniet explicabo hic id incidunt ipsa ipsum laudantium
            magni nam pariatur porro, quod ullam vero.</p>
        <h3 class="">The plot is so great</h3>
        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium
            commodi, consectetur dolorem dolorum, ducimus eius eveniet explicabo hic id incidunt ipsa ipsum laudantium
            magni nam pariatur porro, quod ullam vero.</p>

        <h3 class="">Another section title</h3>
        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi asperiores
            at atque culpa, dolorem, eos est facere harum impedit iste iusto labore mollitia non officiis omnis optio
            provident, quam quibusdam recusandae repudiandae similique suscipit tempore. Eligendi, esse nostrum. Ab
            adipisci alias animi architecto asperiores consequatur doloremque eligendi, esse eum excepturi expedita id
            impedit, in labore laboriosam, laborum minus non odio praesentium provident quam quibusdam quidem recusandae
            sed sit soluta velit voluptatem! Assumenda at delectus doloribus, iste modi perspiciatis suscipit!</p>

        <h3 class="">Another section title</h3>
        <p class="text-primary text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem commodi
            cumque cupiditate in laborum quae reiciendis rerum tempore velit veniam.</p>

        {{-- End of review section --}}

        {{-- Actions section --}}
        <div class="row">
            <div class="col  d-flex flex-column align-items-center">
                <div>702k</div>
                <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                        title="Like">
                    <i class="far fa-thumbs-up line-height-initial"></i>
                </button>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div>500</div>
                <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                        title="Dislike">
                    <i class="far fa-thumbs-down line-height-initial"></i>
                </button>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div>500</div>
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
    <div class="container">
        {{--  poster info  --}}
        <div class="row mb-4">
            <div class="col pr-0  justify-content-start flex-grow-0 d-inline-block">
                <img class="rounded-circle" src="{{ asset('img/man.jpg') }}" width="60" alt="profile picture">
            </div>
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="profile-name mb-1">Eslam Fakhry</h3>
                <div class=""><a href="#"
                                 class="follow-btn btn btn-outline-success btn-sm px-2 py-0 mt-1 rounded-pill ">follow</a>
                </div>
            </div>
        </div>
        {{-- End of  poster info  --}}

        {{-- related reviews --}}
        <h3 class="mt-5">You might like</h3>
        <div class="pt-3">
            <div class="row">
                @for($i=0;$i<4;$i++)
                    <div class="col-md-6 d-flex">
                        <div class="card flex-grow-1">
                            <div class="card-body ">
                                <h5 class="card-title mb-0">Card title</h5>
                                <small class="text-muted">About <strong>War an Peace</strong></small>
                                <p class="card-text mt-2">Some quick example text .</p>
                            </div>
                            <div class="card-body pb-0 flex-grow-0">
                                {{-- Actions section --}}
                                <div class="row">
                                    <div class="col  d-flex flex-column align-items-center">
                                        <div>702k</div>
                                        <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                title="Like">
                                            <i class="far fa-thumbs-up line-height-initial"></i>
                                        </button>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center">
                                        <div>500</div>
                                        <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                title="Dislike">
                                            <i class="far fa-thumbs-down line-height-initial"></i>
                                        </button>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center">
                                        <div>500</div>
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
                @endfor
            </div>

        </div>
        {{-- End of related reviews --}}

        {{-- comment section --}}
        <h3 class="mt-5" id="comments">Comments</h3>
        <div class="media my-4">
            <img src="{{ asset('img/man.jpg') }}" width="40" class="mr-3 rounded-circle " alt="...">
            <div class="media-body">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

            </div>
        </div>
        @for($i=0;$i<3;$i++)
            <div class="media my-4">
                <img src="{{ asset('img/man.jpg') }}" width="40" class="mr-3 rounded-circle " alt="...">
                <div class="media-body">
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                    purus
                    odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                    fringilla. Donec lacinia congue felis in faucibus.
                    @for($j=0;$j<2;$j++)
                        <div class="media my-2">
                            <a class="mr-3" href="#">
                                <img src="{{ asset('img/man.jpg') }}" width="40" class="mr-3 rounded-circle" alt="...">
                            </a>
                            <div class="media-body">
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                                sollicitudin.
                                Cras
                                purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac
                                nisi
                                vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                    @endfor
                    <div class="media my-4">
                        <img src="{{ asset('img/man.jpg') }}" width="40" class="mr-3 rounded-circle " alt="...">
                        <div class="media-body">
                            <textarea class="form-control" id="exampleFormControlTextarea{{$i}}" rows="3"></textarea>

                        </div>
                    </div>

                </div>
            </div>
        @endfor
        {{-- End of comment section --}}


    </div>

@endsection
