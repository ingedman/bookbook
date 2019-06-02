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
            ->wherePivot('is_primary', true);
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

    /**
     * get json object to use in vue card controls component
     *
     * @return false|string
     */
    public function getControlsJsonAttribute()
    {
        $this->loadCount(['likes','dislikes']);
        $controlsJson = [];

        // reactions info
        $controlsJson['likes']['count'] = $this->{'likes_count'};
        $controlsJson['likes']['already'] = $this->{'likes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });
        $controlsJson['dislikes']['count'] = $this->{'dislikes_count'};
        $controlsJson['dislikes']['already'] = $this->{'dislikes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });

        // url
        $controlsJson['url'] = route('book', $this->{'slug'});
        $controlsJson['likeUrl'] = route('book.like', $this->{'id'});
        $controlsJson['dislikeUrl'] = route('book.dislike', $this->{'id'});
        $controlsJson['reportUrl'] = route('book.report', $this->{'id'});
        return json_encode($controlsJson);
    }

    /**
     * get the url of the cover image
     *
     * @return mixed|string
     */
    public function getCoverUrlAttribute(){
        if( \Str::startsWith($this->{'cover'} ,'http')){
            return $this->{'cover'};
        }
        return \Storage::url($this->{'cover'});
    }
}
