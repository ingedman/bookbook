@extends('layouts.app')

@section('content')
    <div class="container border-bottom border-primary">
        {{-- profile header --}}
        <div class="row pb-4">
            <div class="col  justify-content-start flex-grow-0 d-inline-block">
                <img class="rounded-circle" src="{{ asset('img/man.jpg') }}" width="120" alt="profile picture">
            </div>
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="profile-name mb-2">Gamal Fakhry</h3>


            </div>
        </div>
        {{-- End of profile header --}}

        {{-- Actions section --}}
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
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
            <div class="col d-flex flex-column align-items-center justify-content-end ">
                <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                        title="Share">
                    <i class="fas fa-share-alt line-height-initial"></i>
                </button>
            </div>
            <div class="col d-flex flex-column align-items-center justify-content-end">
                <div class="btn-group dropleft">
                    <button class="btn" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h  line-height-initial "></i>

                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="#">Report</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- End of Actions section --}}
    </div>

    {{-- books section --}}
    <div class="container min-vh-100">
        <h3 class="mt-5">Books</h3>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group mt-2">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    order by popularity
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">date</a>
                    <a class="dropdown-item" href="#">popularity</a>

                </div>
            </div>
            <a href="#" class="btn btn-link">show all</a>

        </div>
        <div class="pt-3">
            <div class="row">
                @for($i=0;$i<5;$i++)

                    {{-- single book card --}}
                    <div class="col-md-6 d-flex">
                        <div class="card flex-grow-1">
                            <div class="card-body ">
                                <h5 class="card-title mb-3">Card title</h5>
                                <div class="row">
                                    <div class="col-6 d-flex  justify-content-center  align-items-center flex-grow-0 d-inline-block">
                                        <img class="" src="{{ asset('img/book.jpg') }}" width="144" alt="book cover">
                                    </div>
                                    <div class="col-6">

                                        <div class="row py-2">
                                            <div class="col-sm-6 font-weight-bold">Authors:</div>
                                            <div class="col-sm-6 pl-4 pl-sm-3">
                                                <div class="">Leo Tolstoy</div>
                                                <div class="">Adam Smith</div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-sm-6 font-weight-bold">Genre:</div>
                                            <div class="col-sm-6 pl-4 pl-sm-3"> Horror</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0 flex-grow-0">

                                {{-- book card actions --}}
                                <div class="row">
                                    <div class="col d-flex flex-column align-items-center">
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
                                        <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                title="Comments">
                                            <i class="far fa-comment line-height-initial"></i>
                                        </button>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end hidden-sm-down">
                                        <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                title="Share">
                                            <i class="fas fa-share-alt line-height-initial"></i>
                                        </button>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end hidden-sm-down">
                                        <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom"
                                                title="Read later">
                                            <i class="far fa-bookmark line-height-initial"></i>
                                        </button>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end">
                                        <div class="btn-group dropleft">
                                            <button class="btn" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h  line-height-initial "></i>

                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item hidden-sm-up" href="#">share</a>
                                                <a class="dropdown-item hidden-sm-up" href="#">Read later</a>
                                                <a class="dropdown-item" href="#">Report</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End of book card actions --}}


                            </div>
                        </div>
                    </div>
                    {{-- End of single book card --}}
                @endfor

            </div>

        </div>

    </div>
    {{-- End of books section --}}

@endsection
