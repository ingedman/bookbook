<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
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
     * Display a notifications page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = \Auth::user()->notifications()->paginate(20);
        $recommendation = [];
        $recommendation['users'] = User::inRandomOrder()->take(3)->get();
        $recommendation['reviews'] = \App\Review::inRandomOrder()->take(3)->get();

        return view('user.notifications', compact('notifications','recommendation'));

    }

    /**
     * Get all user's notifications as a json array.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $notifications = \Auth::user()->{'notifications'}->map(function ($item) {
            $notification = $item->data;
            $notification['id'] = $item->id;
            return $notification;
        });
        return response()->json($notifications);
    }

    /**
     * Get all unread notifications as a json array.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnread()
    {
        $notifications = \Auth::user()->{'unreadNotifications'}->map(function ($item) {
            $notification = $item->data;
            $notification['id'] = $item->id;
            return $notification;
        });
        return response()->json($notifications);
    }

    /**
     * Mark all user's notifications as read.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function readAll()
    {
        \Auth::user()->{'unreadNotifications'}->markAsRead();
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Mark the specified user's notification as read.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function read($id)
    {
        \Auth::user()->notifications()->where('id', $id)->get()->markAsRead();
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Delete the specified user's notification.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        \Auth::user()->notifications()->where('id', $id)->delete();
        return response()->json([
            'success' => true
        ]);
    }

}
