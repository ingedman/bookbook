@extends('layouts.app')

@section('content')
    <div class="border-bottom border-primary">
        {{-- book info section --}}
        <div class="row">
            <div class="col-md-6 d-flex  justify-content-center  align-items-center flex-grow-0 d-inline-block">
                <img class="" src="{{ asset('img/book.jpg') }}" width="144" alt="book cover">
            </div>
            <div class="col">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        @if(count($book->authors) > 1)
                            <th class="">Authors</th>
                        @else
                            <th class="">Author</th>

                        @endif
                        <td>
                            @foreach($book->authors as $author)
                                <div class="">{{$author->name}}</div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="">Year:</th>
                        <td>{{$book->year}}</td>
                    </tr>
                    <tr>
                        <th class="">Genre:</th>
                        <td>{{$book->genre}}</td>
                    </tr>
                    <tr>
                        <th class="">Languages:</th>
                        <td>
                            @foreach($book->languages as $language)
                                <div class="">{{$language->name}}<small>
                                        <div class="badge badge-pill badge-primary pl-1">primary</div>
                                    </small></div>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- End of book info section --}}

        {{-- Actions section --}}
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <div>702k</div>
                <i class="fas fa-home line-height-initial"></i>
            </div>
            <div class="col d-flex flex-column align-items-center">
                <div>500</div>
                <i class="fas fa-home line-height-initial"></i>
            </div>
            <div class="col d-flex flex-column align-items-center justify-content-end">
                <i class="fas fa-home line-height-initial"></i>
            </div>
            <div class="col d-flex flex-column align-items-center justify-content-end">
                <i class="fas fa-home line-height-initial"></i>
            </div>
            <div class="col  d-flex flex-column align-items-center justify-content-end">
                <i class="fas fa-home line-height-initial "></i>

            </div>
        </div>

        {{-- End of Actions section --}}
    </div>

    {{-- reviews section --}}
    <div class="container">
        <h3 class="mt-5">Reviews</h3>
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
                    {{-- single review card --}}
                    <div class="col-md-6 d-flex">
                        <div class="card flex-grow-1">
                            <div class="card-body ">
                                <h5 class="card-title mb-0">Card title</h5>
                                <small class="text-muted">By <strong>John Doe</strong></small>
                                <p class="card-text mt-2">Some quick example text .</p>
                            </div>
                            <div class="card-body pb-0 flex-grow-0">
                                <div class="row">
                                    <div class="col d-flex flex-column align-items-center">
                                        <div>708k</div>
                                        <i class="fas fa-home line-height-initial "></i>

                                    </div>
                                    <div class="col d-flex flex-column align-items-center">
                                        <div>708k</div>
                                        <i class="fas fa-home line-height-initial "></i>

                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end">
                                        <i class="fas fa-home line-height-initial"></i>
                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end">
                                        <i class="fas fa-home line-height-initial "></i>

                                    </div>
                                    <div class="col d-flex flex-column align-items-center justify-content-end">
                                        <i class="fas fa-home line-height-initial"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End of single review card --}}
                @endfor
            </div>

        </div>

    </div>
    {{-- End of reviews section --}}

@endsection
