<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
}
