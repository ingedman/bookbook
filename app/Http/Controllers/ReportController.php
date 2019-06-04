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

    /**
     * @param Request $request
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function reviewModel(Request $request, Model $model)
    {
        $model->reports()->create(['reporter_id' => \Auth::user()->{'id'}, 'content' => $request->input('content')]);
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * @param Request $request
     * @param \App\Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportReview(Request $request, \App\Review $review)
    {
        return $this->reviewModel($request, $review);
    }

    /**
     * @param Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportUser(Request $request, \App\User $user)
    {
        return $this->reviewModel($request, $user);
    }

    /**
     * @param Request $request
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportComment(Request $request, \App\Comment $comment)
    {
        return $this->reviewModel($request, $comment);
    }

    /**
     * @param Request $request
     * @param \App\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportBook(Request $request, \App\Book $book)
    {
        return $this->reviewModel($request, $book);
    }

    /**
     * @param Request $request
     * @param \App\Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportAuthor(Request $request, \App\Author $author)
    {
        return $this->reviewModel($request, $author);
    }



}
