<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
     * @param Author $author
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Author $author)
    {
        $allowableSort = ['title', 'created_at', 'id'];
        $sort = $request->input('sort', 'id');
        $books = $author->books()->withCount('likes');
        if ($sort === 'popular') {
            $books = $books->orderBy('likes_count','DESC');
        } elseif (in_array($sort, $allowableSort)) {
            $books = $books->orderBy($sort);
        }
        $books = $books->paginate(5)
            ->appends('order', $request->input('order'));

        $recommendation = [];
        $recommendation['users'] = \App\User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();

        return view('author.show', compact('author', 'books', 'recommendation'));
    }
}
