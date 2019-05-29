<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
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
     * Display the specified book.
     *
     * @param Request $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->with('poster', 'authors', 'languages')->firstOrFail();

        $allowableSort = ['title', 'created_at', 'id'];
        $sort = $request->input('sort', 'id');
        $reviews = $book->reviews()->withCount('likes');

        if ($sort === 'popular') {
            $reviews = $reviews->orderBy('likes_count','DESC');

        } elseif (in_array($sort, $allowableSort)) {
            $reviews = $reviews->orderBy($sort);
        }

        $reviews = $reviews->paginate(5)
            ->appends('sort', $request->input('sort'));

        $recommendation = [];
        $recommendation['users'] = \App\User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();


        return view('book.show', compact('book', 'reviews', 'recommendation'));
    }
}
