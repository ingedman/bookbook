<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentOnReview;
use App\Notifications\RepliedOnComment;
use App\Review;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class ReviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the feed of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $feed = \Auth::user()
            ->feed()
            ->with('reviewer', 'book')
            ->paginate(20);
        $recommendation = [];
        $recommendation['users']=\App\User::inRandomOrder()->take(3)->get();
        $recommendation['reviews']= Review::inRandomOrder()->take(3)->get();
        return view('home', compact('feed','recommendation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $save_url = route('review.store');

        if ($request->has('book')) {
            $bookModel = \App\Book::where('slug', $request->input('book'))->with('poster', 'authors', 'languages')->firstOrFail();

            $book = json_encode([
                'id' => $bookModel->{'id'},
                'title' => $bookModel->{'title'}
            ]);

            return view('review.create', compact('save_url', 'book'));

        }

        return view('review.create', compact('save_url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'book_id.required' => 'You should select a book',
            'book_id.exists' => 'You should select a book',
        ];
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'book_id' => 'required|exists:books,id'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Review::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'reviewer_id' => \Auth::user()->{'id'},
            'language_id' => 1,
            'book_id' => $request->input('book_id'),
        ]);
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $review = Review::where('slug', $slug)->with('book', 'reviewer')->firstOrFail();
        $recommendation = [];
        $recommendation['users'] = \App\User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = Review::inRandomOrder()->take(3)->get();
        $similarReviews = $recommendation['reviews'];

        return view('review.show', compact('review', 'similarReviews', 'recommendation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $review = Review::where('slug', $slug)->with('book')->firstOrFail();

        // todo: fix Gates problem with voyager

        if (\Gate::allows('edit-review', $review)) {
            $save_url = route('review.update', $review->{'id'});

            $book = json_encode([
                'id' => $review->{'book'}->{'id'},
                'title' => $review->{'book'}->{'title'}
            ]);

            return view('review.create', compact('review', 'save_url', 'book'));
        } else {
            return redirect()->route('review', $slug);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug)
    {
        $messages = [
            'book_id.required' => 'You should select a book',
            'book_id.exists' => 'You should select a book',
        ];
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'book_id' => 'required|exists:books,id'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $review = Review::where('slug', $slug)->firstOrFail();
        if (\Gate::allows('edit-review', $review)) {

            $review->update($request->only(['title', 'content', 'book_id']));

            return response()->json([
                'success' => true
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        // todo: add review delete button
    }


}
