<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Sluggable;


    protected $cast = [
        'is_flagged' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function likes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', true);
    }

    public function dislikes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', false);
    }

    public function getCommentsCountAttribute()
    {
        $comments = $this->comments;
        if (count($comments) > 0) {
            return $comments->reduce(function ($carry, $item) {
                return $carry + count($item->replies) + 1;
            });
        } else {
            return 0;
        }
    }
    public function getControlsJsonAttribute(){

        $controlsJson = [];

        $controlsJson['comments_url'] = '#comments';
        $controlsJson['likes']['count'] = count($this->likes);
        $controlsJson['likes']['already'] = count($this->likes->where('user_id', \Auth::user()->id))>0;
        $controlsJson['dislikes']['count'] = count($this->dislikes);
        $controlsJson['dislikes']['already'] = count($this->dislikes->where('user_id', \Auth::user()->id)) > 0;
        $controlsJson['comments']['count'] = $this->{'commentsCount'};
        $controlsJson['url'] = route('review',$this->{'slug'});
        $controlsJson['reportUrl'] = route('review.report', $this->id);

        return json_encode($controlsJson);
    }

    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = trim($val);
    }
}
