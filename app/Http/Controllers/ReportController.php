<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReportController extends Controller
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

    public function reviewModel(Request $request, Model $model)
    {
        $model->reports()->create(['reporter_id' => \Auth::user()->{'id'}, 'content' => $request->input('content')]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function reportReview(Request $request, \App\Review $review)
    {
        return $this->reviewModel($request, $review);
    }

    public function reportUser(Request $request, \App\User $user)
    {
        return $this->reviewModel($request, $user);
    }

    public function reportComment(Request $request, \App\Comment $comment)
    {
        return $this->reviewModel($request, $comment);
    }

    public function reportBook(Request $request, \App\Book $book)
    {
        return $this->reviewModel($request, $book);
    }

    public function reportAuthor(Request $request, \App\Author $author)
    {
        return $this->reviewModel($request, $author);
    }


}
