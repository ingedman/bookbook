<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * Display a notifications page.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $notifications = \Auth::user()->notifications()->paginate(20);
//        dd($notifications);
        $recommendation = [];
        $recommendation['users'] = User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();

        return view('user.notifications', compact('notifications','recommendation'));

    }

    public function getAll()
    {
        $notifications = \Auth::user()->notifications->map(function ($item) {
            $notification = $item->data;
            $notification['id'] = $item->id;
//            $item->data->url = $item->id;
            return $notification;
        });
        return response()->json($notifications);
    }

    public function getUnread()
    {
        $notifications = \Auth::user()->unreadNotifications->map(function ($item) {
            $notification = $item->data;
            $notification['id'] = $item->id;
//            $item->data->url = $item->id;
            return $notification;
        });
        return response()->json($notifications);
    }

    public function readAll()
    {
        \Auth::user()->unreadNotifications->markAsRead();
        return response()->json([
            'success' => true
        ]);
    }

    public function read($id)
    {
        \Auth::user()->notifications()->where('id', $id)->get()->markAsRead();
        return response()->json([
            'success' => true
        ]);
    }

    public function delete($id)
    {
//        dd(\Auth::user()->notifications->where('id',$id));
        \Auth::user()->notifications()->where('id', $id)->delete();

        return response()->json([
            'success' => true
        ]);
    }

}
