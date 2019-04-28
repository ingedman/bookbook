@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center d">
            {{-- main feed section --}}
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                           aria-controls="all" aria-selected="true">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                           aria-controls="reviews" aria-selected="true">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="books-tab" data-toggle="tab" href="#books" role="tab"
                           aria-controls="books" aria-selected="false">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="authors-tab" data-toggle="tab" href="#authors" role="tab"
                           aria-controls="authors" aria-selected="false">Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reviewers-tab" data-toggle="tab" href="#reviewers" role="tab"
                           aria-controls="reviewers" aria-selected="false">Reviewers</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">all Lorem
                        ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ex fuga ipsa molestiae? Adipisci
                        aliquam deleniti dicta dolorem eos ex facere harum, inventore laboriosam libero, nostrum odit
                        praesentium reprehenderit sequi?
                    </div>
                    <div class="tab-pane fade " id="reviews" role="tabpanel" aria-labelledby="reviews-tab">reviews Lorem
                        ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ex fuga ipsa molestiae? Adipisci
                        aliquam deleniti dicta dolorem eos ex facere harum, inventore laboriosam libero, nostrum odit
                        praesentium reprehenderit sequi?
                    </div>
                    <div class="tab-pane fade" id="books" role="tabpanel" aria-labelledby="books-tab">books Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit. Aperiam earum illum ipsum itaque iure iusto maxime
                        nulla numquam porro possimus provident sed sequi sit sunt tempore tenetur, ullam unde vitae?
                    </div>
                    <div class="tab-pane fade" id="authors" role="tabpanel" aria-labelledby="authors-tab">authors Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit. Accusamus ad aliquid beatae, cum delectus
                        doloribus ex ipsa minima perspiciatis porro recusandae repudiandae tempore? Ab consequuntur
                        corporis dicta harum in laudantium.
                    </div>
                    <div class="tab-pane fade" id="reviewers" role="tabpanel" aria-labelledby="reviewers-tab">reviewers Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit. Accusamus ad aliquid beatae, cum delectus
                        doloribus ex ipsa minima perspiciatis porro recusandae repudiandae tempore? Ab consequuntur
                        corporis dicta harum in laudantium.
                    </div>
                </div>

            </div>
            {{-- End of main feed section --}}
        </div>
    </div>
@endsection
