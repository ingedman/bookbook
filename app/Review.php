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

    public function likes(){
        return $this->morphMany(Reaction::class,'reactionable')->where('is_like','=',true);
    }
    public function dislikes(){
        return $this->morphMany(Reaction::class,'reactionable')->where('is_like','=',false);
    }

    public function setTitleAttribute($val){
        $this->attributes['title'] = trim($val);
    }
}
