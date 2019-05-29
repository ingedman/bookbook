<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    public $follower;

    /**
     * Create a new notification instance.
     *
     * @param User $follower
     */
    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }




    public function toBroadcast($notifiable)
    {
//        dd('s');
//        \Log::debug('An informational message.');
        return new BroadcastMessage([
            'message'=>"{$this->follower->{'name'}} has followed you",
            'url'=>route('user.profile',$this->follower->{'id'} )
        ]);
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message'=>"{$this->follower->{'name'}} has followed you",
            'url'=>route('user.profile',$this->follower->{'id'} )
        ];
    }
}
