<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'parent_id','comment','user_id'
    ];

    protected $cast = [
        'is_flagged'=>'boolean',
    ];


    /**
     * Get the commented on model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get parent comment of a specified reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(Comment::class,'parent_id');
    }

    /**
     * Get the replies of the specified comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(){
        return $this->hasMany(Comment::class,'parent_id');
    }

    /**
     * Get the reports of the specified comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * Get the commenter of the specified comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commenter(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get likes of the specified Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes(){
        return $this->morphMany(Reaction::class,'reactionable')->where('is_like','=',true);
    }

    /**
     * Get dislikes of the specified Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function dislikes(){
        return $this->morphMany(Reaction::class,'reactionable')->where('is_like','=',false);
    }

    /**
     * get info array to use in vue card controls component
     *
     * @return array
     */
    public function getCommentControlsAttribute()
    {
        $this->loadCount(['likes','dislikes','replies']);

        $comment = [];
        $comment['comment'] = $this->{'comment'};
        $comment['id'] = $this->{'id'};
        $comment['date'] = $this->{'updated_at'}->diffForHumans();
        $comment['user']['name'] = $this->{'commenter'}->{'name'};
        $comment['user']['photo'] = $this->{'commenter'}->{'avatarUrl'};


        $comment['likes']['count'] = $this->{'likes_count'};
        $comment['likes']['already'] = $this->{'likes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });
        $comment['dislikes']['count'] = $this->{'dislikes_count'};
        $comment['dislikes']['already'] = $this->{'dislikes'}->contains(function ($dislike) {
            return $dislike->user_id == \Auth::user()->{'id'};
        });

        // urls
        $comment['likeUrl'] = route('comment.like', $this->{'id'});
        $comment['dislikeUrl'] = route('comment.dislike', $this->{'id'});
        $comment['reportUrl'] = route('comment.report', $this->{'id'});

        // replies info
        if (!$this->{'parent'}){
        $comment['replies']['count'] = $this->{'replies_count'};
        $comment['replies']['url'] = route('replies', $this->{'id'});
        }

        return $comment;
    }
}
