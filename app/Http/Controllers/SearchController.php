<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\Config\SearchConfig;
use Algolia\AlgoliaSearch\SearchClient;
use App\Book;
use App\Review;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
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
     * Search books table.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function books(Request $request)
    {
        if ($request->has('q') and strlen($request->input('q')) > 1) {

            $q = $request->input('q');

            $books = Book::where('title', 'LIKE', '%' . $q . '%')->get();
        } else {
            $books = Book::take(3)->get();
        }


        $books = $books->map(function ($item) {
            return [
                'id' => $item->{'id'},
                'title' => $item->{'title'}
            ];
        });
        return response()->json($books);
    }

    /**
     * Search books, users, and reviews tables by algolia.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
    public function all(Request $request)
    {
        // todo: handle algolia curl timeout error
//        $config = SearchConfig::create(env('ALGOLIA_APP_ID', ''), env('ALGOLIA_SECRET', ''));
//        $config->setConnectTimeout(10);
//        $config->setReadTimeout(30);
//        $config->setWriteTimeout(30);
//        SearchClient::createWithConfig($config);

        if ($request->has('q') and strlen($request->input('q')) > 1) {

            return retry(5, function () use ($request) {
                // Attempt 5 times while resting 100ms in between attempts...

                $q = $request->input('q');
//
                $books = Book::search($q)->take(3)->get()->map(function ($item) {
                    return [
                        'id' => $item->{'id'},
                        'url' => route('book', $item->{'slug'}),
                        'text' => $item->{'title'}
                    ];
                });

                $reviews = Review::search($q)->take(3)->get()->map(function ($item) {
                    return [
                        'id' => $item->{'id'},
                        'url' => route('review', $item->{'slug'}),
                        'text' => $item->{'title'}
                    ];
                });

                $users = User::search($q)->take(3)->get()->map(function ($item) {
                    return [
                        'id' => $item->{'id'},
                        'url' => route('user.profile', $item->{'id'}),
                        'text' => $item->{'name'}
                    ];
                });

//                $models = \App\Search\Models::search($q)->get()->toArray();
//                return response()->json(['books' => $models]);
//dd($models);
//                $books = array_filter($models, function ($model){
//                    return get_class($model) === 'App\Book';
//                });
//
//                $users = array_filter($models, function ($model){
//                    return get_class($model) === 'App\User';
//                });
//
//                $reviews = array_filter($models, function ($model){
//                    return get_class($model) === 'App\Review';
//                });


                return response()->json([
                    'books' => $books,
                    'users' => $users,
                    'reviews' => $reviews
                ]);
            }, 100);

        } else {
            return response()->json([]);
        }

    }
}
