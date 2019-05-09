<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Review;
use Illuminate\Http\Request;

class CommentController extends Controller
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

    public function comments(Review $review)
    {
        $comments = $review->comments()->latest()->paginate(30)->map(function ($item) {
            $comment = [];
            $comment['comment'] = $item->comment;
            $comment['id'] = $item->id;
            $comment['date'] = $item->updated_at->diffForHumans();
            $comment['user']['name'] = $item->commenter->name;
            $comment['user']['photo'] = $item->commenter->photo;
            $comment['likes']['count'] = count($item->likes);
            $comment['likes']['already'] = count($item->likes->where('user_id', \Auth::user()->id)) > 0;

            $comment['dislikes']['count'] = count($item->dislikes);
            $comment['dislikes']['already'] = count($item->dislikes->where('user_id', \Auth::user()->id)) > 0;

            $comment['replies']['count'] = $item->{'repliesCount'};
            $comment['replies']['url'] = route('replies', $item->id);

            $comment['likeUrl'] = route('comment.like', $item->id);
            $comment['dislikeUrl'] = route('comment.dislike', $item->id);
            $comment['reportUrl'] = route('comment.report', $item->id);

            return $comment;
        });
//        dd($comments);
        return json_encode($comments);
    }

    public function replies(Comment $comment)
    {
        $replies = $comment->replies()->latest()->paginate(30)->map(function ($item) {
            $comment = [];
            $comment['comment'] = $item->comment;
            $comment['id'] = $item->id;
            $comment['date'] = $item->updated_at->diffForHumans();
            $comment['user']['name'] = $item->commenter->name;
            $comment['user']['photo'] = $item->commenter->photo;
            $comment['likes']['count'] = count($item->likes);
            $comment['likes']['already'] = count($item->likes->where('user_id', \Auth::user()->id)) > 0;

            $comment['dislikes']['count'] = count($item->dislikes);
            $comment['dislikes']['already'] = count($item->dislikes->where('user_id', \Auth::user()->id)) > 0;

            $comment['likeUrl'] = route('comment.like', $item->id);
            $comment['dislikeUrl'] = route('comment.dislike', $item->id);
            $comment['reportUrl'] = route('comment.report', $item->id);


            return $comment;
        });

//        dd($replies);
        return json_encode($replies);
    }

    public function like(Comment $comment)
    {

        $likes = $comment->likes->where('user_id', \Auth::user()->id);
//        dd($likes);
        if (count($likes) > 0) {
            $comment->likes()->where('user_id', \Auth::user()->id)->delete();
            $already = false;
        } else {
            if (count($dislikes = $comment->dislikes->where('user_id', \Auth::user()->id)) > 0) {
                $comment->dislikes()->where('user_id', \Auth::user()->id)->delete();
            }
            $comment->likes()->create(['user_id' => \Auth::user()->id, 'is_like' => true]);
            $already = true;
        }

        $comment->refresh();
        return response()->json([
            'likes' => [
                'count' => count($comment->likes),
                'already' => $already,
            ],
            'dislikes' => [
                'count' => count($comment->dislikes),
                'already' => false,
            ],
        ]);
    }

    public function dislike(Comment $comment)
    {

        $dislikes = $comment->dislikes->where('user_id', \Auth::user()->id);

        if (count($dislikes) > 0) {
            $comment->dislikes()->where('user_id', \Auth::user()->id)->delete();
            $already = false;

        } else {
            if (count($likes = $comment->likes->where('user_id', \Auth::user()->id)) > 0) {
                $comment->likes()->where('user_id', \Auth::user()->id)->delete();
            }
            $comment->dislikes()->create(['user_id' => \Auth::user()->id, 'is_like' => false]);
            $already = true;

        }
        $comment->refresh();
        return response()->json([
            'likes' => [
                'count' => count($comment->likes),
                'already' => false,
            ],
            'dislikes' => [
                'count' => count($comment->dislikes),
                'already' => $already,
            ],
        ]);
    }

    public function report(Request $request, Comment $comment)
    {
        $comment->reports()->create(['reporter_id' => \Auth::user()->id, 'content' => $request->input('content')]);
        return response()->json([
            'success' => true,
        ]);
    }

}
