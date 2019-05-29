<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use \App\User;
use \App\Comment;

class CommentOnReview extends Notification implements ShouldQueue
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
    public function __construct(User $commenter,Comment $comment)
    {
        $this->commenter = $commenter;
        $this->comment = $comment;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message'=>"{$this->commenter->{'name'}}  has commented on your review",
            'url'=>route('review',$this->comment->commentable->{'slug'} )
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message'=>"{$this->commenter->{'name'}} has commented on your review",
            'url'=>route('review',$this->comment->commentable->{'slug'} )

        ];
    }
}
