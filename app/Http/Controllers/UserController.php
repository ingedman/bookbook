<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowed;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * Display profile page of a user.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request, User $user)
    {
        $allowableSort = ['title', 'created_at', 'id'];
        $sort = $request->input('sort', 'id');
        $reviews = $user->reviews()->withCount('likes');

        if ($sort === 'popular') {
            $reviews = $reviews->orderBy('likes_count','DESC');

        } elseif (in_array($sort, $allowableSort)) {
            $reviews = $reviews->orderBy($sort);
        }
        $reviews = $reviews->paginate(5)
            ->appends('sort', $request->input('sort'));
        $recommendation = [];
        $recommendation['users'] = User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();
        return view('user.profile', compact('user', 'reviews', 'recommendation'));
    }


    /**
     * Display Authenticated user profile page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function ownProfile(Request $request)
    {
        return $this->profile($request, \Auth::user());
    }


    /**
     * Toggle following state of a user to user
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(User $user)
    {
        if (\Auth::user()->isNot($user)) {
            $user->followers()->toggle(\Auth::user());
            $already = $user->{'followers'}->contains(\Auth::user());
            if ($already) $user->notify(new UserFollowed(\Auth::user()));
            return response()->json([
                'success' => true,
                'already' => $already,
            ]);
        }
        return response()->json([
            'success' => false,
        ]);
    }

    /**
     * Display user list of followers.
     *
     * @return \Illuminate\Http\Response
     */
    public function followers()
    {
        $users = \Auth::user()->followers()->paginate(20);
        $emptyMsg = "Nobody is following you right now";
        $recommendation = [];
        $recommendation['users'] = User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();

        return view('user.followers', compact('users', 'emptyMsg', 'recommendation'));
    }

    /**
     * Display user list page of a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function following()
    {
        $users = \Auth::user()->followings()->paginate(20);
        $emptyMsg = "You are not following any on right now";
        $recommendation = [];
        $recommendation['users'] = User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();
        return view('user.followers', compact('users', 'emptyMsg', 'recommendation'));
    }

    /**
     * Remove the specified user from database.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        if ($request->input('confirm_text') === \Auth::user()->{'email'}) {
            $user = \Auth::user();
            $user->delete();
            return redirect()->route('home');
        }
        return redirect()->back();
    }
}
