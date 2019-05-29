<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentEvent;
use App\Notifications\CommentOnReview;
use App\Notifications\RepliedOnComment;
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
            return $item->commentControls;
        });
        return json_encode($comments);
    }


    public function replies(Comment $comment)
    {
        $replies = $comment->replies()->oldest()->paginate(30)->map(function ($item) {
            return $item->commentControls;
        });
        return json_encode($replies);
    }
    public function addComment(Request $request, string $slug)
    {

        $review = Review::where('slug', $slug)->firstOrFail();

        $comment = $review->comments()->create([
            'user_id' => \Auth::user()->{'id'},
            'comment' => $request->input('comment'),
            'parent_id' => $request->input('parent_id'),
        ]);

        try{
            if (\Auth::user()->isNot($review->{'reviewer'})) {
                $review->{'reviewer'}->notify(new CommentOnReview(\Auth::user(), $comment));
            }
            if ($request->input('parent_id')) {
                $parentComment = Comment::find($request->input('parent_id'));
                if ($parentComment && \Auth::user()->isNot($parentComment->{'commenter'})) $parentComment->{'commenter'}->notify(new RepliedOnComment(\Auth::user(), $comment));
            }
            broadcast(new CommentEvent( $comment))->toOthers();
        }catch (\Exception $e){
            \Log::error($e);
        }
        return response()->json([
            'success' => true,
            'comment' => json_encode($comment->{'commentControls'})
        ]);
    }

//    public function like(Comment $comment)
//    {
//        $likes = $comment->{'likes'}->where('user_id', \Auth::user()->{'id'});
//        if (count($likes) > 0) {
//            $comment->likes()->where('user_id', \Auth::user()->{'id'})->delete();
//            $already = false;
//        } else {
//            if (count($dislikes = $comment->{'dislikes'}->where('user_id', \Auth::user()->{'id'})) > 0) {
//                $comment->dislikes()->where('user_id', \Auth::user()->{'id'})->delete();
//            }
//            $comment->likes()->create(['user_id' => \Auth::user()->{'id'}, 'is_like' => true]);
//            $already = true;
//        }
//
//        $comment->refresh();
//        return response()->json([
//            'likes' => [
//                'count' => count($comment->{'likes'}),
//                'already' => $already,
//            ],
//            'dislikes' => [
//                'count' => count($comment->{'dislikes'}),
//                'already' => false,
//            ],
//        ]);
//    }
//
//
//
//    public function dislike(Comment $comment)
//    {
//        $dislikes = $comment->{'dislikes'}->where('user_id', \Auth::user()->{'id'});
//        if (count($dislikes) > 0) {
//            $comment->dislikes()->where('user_id', \Auth::user()->{'id'})->delete();
//            $already = false;
//        } else {
//            if (count($likes = $comment->{'likes'}->where('user_id', \Auth::user()->{'id'})) > 0) {
//                $comment->likes()->where('user_id', \Auth::user()->{'id'})->delete();
//            }
//            $comment->dislikes()->create(['user_id' => \Auth::user()->{'id'}, 'is_like' => false]);
//            $already = true;
//        }
//        $comment->refresh();
//        return response()->json([
//            'likes' => [
//                'count' => count($comment->{'likes'}),
//                'already' => false,
//            ],
//            'dislikes' => [
//                'count' => count($comment->{'dislikes'}),
//                'already' => $already,
//            ],
//        ]);
//    }



}
