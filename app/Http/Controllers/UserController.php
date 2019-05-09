<?php

namespace App\Http\Controllers;

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
     * Display a profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('user.profile');
    }

    /**
     * Display a profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function like()
    {
        return view('user.profile');
    }


    /**
     * Display a Settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('user.settings');
    }


    /**
     * Display a notifications page.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications()
    {
        return view('user.notifications');
    }


    public function follow(User $user)
    {
        $user->followers()->toggle(\Auth::user());
        $already = count($user->followers->where('id',\Auth::user()->id))>0;

        return response()->json([
            'already'=>$already,
        ]);
    }

    public function report(Request $request, User $user)
    {
        $user->reports()->create(['reporter_id' => \Auth::user()->id,'content' => $request->input('content')]);
        return response()->json([
            'success'=>true,
        ]);
    }
}
