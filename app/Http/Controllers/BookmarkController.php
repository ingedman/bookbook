<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class BookmarkController extends Controller
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
     * Display a Bookmarks page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = \Auth::user()->readList()->paginate(10);
        $recommendation = [];
        $recommendation['users'] = \App\User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = Review::inRandomOrder()->take(3)->get();
        return view('user.bookmarks', compact('bookmarks', 'recommendation'));
    }

    /**
     * Add and remove a review from user read list
     *
     * @param Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookmarkReview(Review $review)
    {
        \Auth::user()->readList()->toggle($review);
        $already = \Auth::user()->{'readList'}->contains($review);
        return response()->json([
            'already' => $already,
        ]);
    }

}
