<?php

namespace App\Events;

use App\Comment;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * the comment details
     *
     * @var Comment
     */
    public $comment;

    private $review_id;


    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Comment $comment
     */
    public function __construct( Comment $comment)
    {
        $this->comment = $comment->{'commentControls'};
        $this->comment['parent'] = $comment->{'parent_id'};

        $this->review_id = $comment->{'commentable'}->{'id'};
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('review.comments.'. $this->review_id);
    }
}
