<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class ReactionController extends Controller
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
     * Like logic for eloquent model.
     *
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeModel(Model $model)
    {
        logger('before refresh',[$model]);
        $alreadyLiked = $model->{'likes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });

        if ($alreadyLiked) {
            $model->likes()->where('user_id', \Auth::user()->{'id'})->delete();
            $already = false;
        } else {

            $alreadyDisliked = $model->{'dislikes'}->contains(function ($like) {
                return $like->user_id == \Auth::user()->{'id'};
            });

            if ($alreadyDisliked) {
                $model->dislikes()->where('user_id', \Auth::user()->{'id'})->delete();
            }
            $model->likes()->create(['user_id' => \Auth::user()->{'id'}, 'is_like' => true]);
            $already = true;
        }

        $model->refresh()->loadCount(['likes','dislikes']);


        return response()->json([
            'likes' => [
                'count' => $model->{'likes_count'},
                'already' => $already,
            ],
            'dislikes' => [
                'count' => $model->{'dislikes_count'},
                'already' => false,
            ],
        ]);
    }

    /**
     * dislike logic for eloquent model.
     *
     * @param Model $model
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislikeModel(Model $model)
    {
        $alreadyDisliked = $model->{'dislikes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });

        if ($alreadyDisliked) {
            $model->dislikes()->where('user_id', \Auth::user()->{'id'})->delete();
            $already = false;
        } else {

            $alreadyLiked = $model->{'likes'}->contains(function ($like) {
                return $like->user_id == \Auth::user()->{'id'};
            });

            if ($alreadyLiked) {
                $model->likes()->where('user_id', \Auth::user()->{'id'})->delete();
            }
            $model->dislikes()->create(['user_id' => \Auth::user()->{'id'}, 'is_like' => false]);
            $already = true;

        }
        $model->refresh();
        return response()->json([
            'likes' => [
                'count' => $model->{'likes'}->count(),
                'already' => false,
            ],
            'dislikes' => [
                'count' => $model->{'dislikes'}->count(),
                'already' => $already,
            ],
        ]);
    }

    /**
     * @param \App\Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeReview(\App\Review $review){
        return $this->likeModel($review);
    }

    /**
     * @param \App\Review $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislikeReview(\App\Review $review){
        return $this->dislikeModel($review);
    }

    /**
     * @param \App\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeBook(\App\Book $book){
        return $this->likeModel($book);
    }

    /**
     * @param \App\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislikeBook(\App\Book $book){
        return $this->dislikeModel($book);
    }

    /**
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeComment(\App\Comment $comment){
        return $this->likeModel($comment);
    }

    /**
     * @param \App\Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function dislikeComment(\App\Comment $comment){
        return $this->dislikeModel($comment);
    }







}
