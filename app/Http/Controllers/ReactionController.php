<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function like(Model $model)
    {

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

        $model->refresh();

        return response()->json([
            'likes' => [
                'count' => count($model->{'likes'}),
                'already' => $already,
            ],
            'dislikes' => [
                'count' => count($model->{'dislikes'}),
                'already' => false,
            ],
        ]);
    }

    public function dislike(Model $model)
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
                'count' => count($model->{'likes'}),
                'already' => false,
            ],
            'dislikes' => [
                'count' => count($model->{'dislikes'}),
                'already' => $already,
            ],
        ]);
    }

    public function likeReview(\App\Review $review){
        return $this->like($review);
    }
    public function dislikeReview(\App\Review $review){
        return $this->dislike($review);
    }

    public function likeBook(\App\Book $book){
        return $this->like($book);
    }
    public function dislikeBook(\App\Book $book){
        return $this->dislike($book);
    }

    public function likeComment(\App\Comment $comment){
        return $this->like($comment);
    }
    public function dislikeComment(\App\Comment $comment){
        return $this->dislike($comment);
    }







}
