<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the feed of the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $feed = \Auth::user()
            ->feed()
            ->with('reviewer', 'book')
            ->paginate(20);

        $recommendation = [];
        $recommendation['users']=User::inRandomOrder()->take(3)->get();
        $recommendation['reviews']= Review::inRandomOrder()->take(3)->get();
//        dump($recommended_users);
//        dd($recommended_reviews);
        return view('home', compact('feed','recommendation'));
    }


}
