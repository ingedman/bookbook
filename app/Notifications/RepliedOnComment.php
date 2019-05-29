<?php

namespace App\Notifications;

use App\Comment;
use \App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RepliedOnComment extends Notification implements ShouldQueue
{
    use Queueable;
    public $commenter;
    public $comment;


    /**
     * Create a new notification instance.
     *
     * @param User $commenter
     * @param Comment $comment
     */
    public function __construct(User $commenter, Comment $comment)
    {
        $this->commenter = $commenter;
        $this->comment = $comment;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message'=>"{$this->commenter->{'name'}} has replied on your comment",
            'url'=>route('review',$this->comment->commentable->{'slug'} )

        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message'=>"{$this->commenter->{'name'}} has replied on your comment",
            'url'=>route('review',$this->comment->commentable->{'slug'} )

        ];
    }


}
