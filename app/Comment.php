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
    protected $touches = ['commentable'];

    public function commentable()
    {
        return $this->morphTo();
    }
    public function parent(){
        return $this->belongsTo(Comment::class,'parent_id');
    }
    public function replies(){
        return $this->hasMany(Comment::class,'parent_id');
    }
    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }
    public function commenter(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function likes(){
        return $this->morphMany(Reaction::class,'reactionable')->where('is_like','=',true);
    }
    public function dislikes(){
        return $this->morphMany(Reaction::class,'reactionable')->where('is_like','=',false);
    }
//    public function getRepliesCountAttribute()
//    {
//        return count($this->replies);
//    }

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
