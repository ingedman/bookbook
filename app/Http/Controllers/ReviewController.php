<?php

namespace App\Http\Controllers;

use App\Reaction;
use App\Review;
use Illuminate\Http\Request;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $review = Review::where('slug', $slug)->with('book', 'reviewer')->firstOrFail();

        $already = count($review->reviewer->followers->where('id',\Auth::user()->id))>0;

        $review->reviewer->alreadyFollowed = $already;

        $similarReviews =  Review::paginate(3);

        return view('review.show', [
            'review' => $review,
            'similarReviews' => $similarReviews
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }

    public function like(string $slug)
    {

        $review = Review::where('slug', $slug)->firstOrFail();
        $likes = $review->likes->where('user_id', \Auth::user()->id);

        if (count($likes) > 0) {
            $review->likes()->where('user_id', \Auth::user()->id)->delete();
            $already = false;
        } else {
            if (count($dislikes = $review->dislikes->where('user_id', \Auth::user()->id)) > 0) {
                $review->dislikes()->where('user_id', \Auth::user()->id)->delete();
            }
            $review->likes()->create(['user_id' => \Auth::user()->id, 'is_like' => true]);
            $already = true;
        }

        $review->refresh();

        return response()->json([
            'likes' => [
                'count' => count($review->likes),
                'already' => $already,
            ],
            'dislikes' => [
                'count' => count($review->dislikes),
                'already' => false,
            ],
        ]);
    }

    public function dislike(string $slug)
    {

        $review = Review::where('slug', $slug)->firstOrFail();
        $dislikes = $review->dislikes->where('user_id', \Auth::user()->id);

        if (count($dislikes) > 0) {
            $review->dislikes()->where('user_id', \Auth::user()->id)->delete();
            $already = false;

        } else {
            if (count($likes = $review->likes->where('user_id', \Auth::user()->id)) > 0) {
                $review->likes()->where('user_id', \Auth::user()->id)->delete();
            }
            $review->dislikes()->create(['user_id' => \Auth::user()->id, 'is_like' => false]);
            $already = true;

        }
        $review->refresh();
        return response()->json([
            'likes' => [
                'count' => count($review->likes),
                'already' => false,
            ],
            'dislikes' => [
                'count' => count($review->dislikes),
                'already' => $already,
            ],
        ]);
    }

    public function comment(Request $request, string $slug)
    {

        $review = Review::where('slug', $slug)->firstOrFail();

        $review->comments()->create([
            'user_id' => \Auth::user()->id,
            'comment' => $request->input('comment'),
            'parent_id' => $request->input('parent_id'),
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function report(Request $request, Review $review)
    {
        $review->reports()->create(['reporter_id' => \Auth::user()->id, 'content' => $request->input('content')]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function getComments(Review $review)
    {
        $comments = $review->comments()->paginate(30)->map(function ($item) {
            $comment = [];
            $comment['comment'] = $item->comment;
            $comment['id'] = $item->id;
            $comment['date'] = $item->updated_at->diffForHumans();
            $comment['user']['name'] = $item->commenter->name;
            $comment['user']['photo'] = $item->commenter->photo;
            $comment['likes']['count'] = count($item->likes);
            $comment['likes']['already'] = count($item->likes->where('user_id', \Auth::user()->id))>0;
            $comment['dislikes']['count'] = count($item->dislikes);
            $comment['dislikes']['already'] = count($item->dislikes->where('user_id', \Auth::user()->id)) > 0;
            $comment['replies']['count'] = $item->{'repliesCount'};

            return $comment;
        });
//        dd($comments);
        return $comments;
    }
}
