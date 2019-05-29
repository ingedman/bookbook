<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Book extends Model
{
    use Sluggable;
    use Searchable;

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable')->withPivot('is_primary');
    }

    public function nativeLanguage()
    {

        return $this
            ->morphToMany(Language::class, 'languageable')
            ->withPivot('is_primary')
            ->where('is_primary', true);
    }

    public function likes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', true);
    }

    public function dislikes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', false);
    }

    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = trim($val);
    }

    public function getControlsJsonAttribute()
    {

        $controlsJson = [];

        $controlsJson['comments_url'] = '#comments';
        $controlsJson['likes']['count'] = count($this->likes);
        $controlsJson['likes']['already'] = count($this->likes->where('user_id', \Auth::user()->{'id'})) > 0;
        $controlsJson['dislikes']['count'] = count($this->dislikes);
        $controlsJson['dislikes']['already'] = count($this->dislikes->where('user_id', \Auth::user()->{'id'})) > 0;
//        $controlsJson['comments']['count'] = $this->{'commentsCount'};
        $controlsJson['url'] = route('book', $this->{'slug'});

        $controlsJson['likeUrl'] = route('book.like', $this->{'id'});
        $controlsJson['dislikeUrl'] = route('book.dislike', $this->{'id'});
        $controlsJson['reportUrl'] = route('book.report', $this->{'id'});

        return json_encode($controlsJson);
    }
    public function getCoverUrlAttribute(){
        if( \Str::startsWith($this->{'cover'} ,'http')){
            return $this->{'cover'};
        }
        return \Storage::url($this->{'cover'});
    }
}
