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

    /**
     * Get the reviews of the specified book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the authors of the specified book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * Get the poster of the specified book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    /**
     * Get the reports of the specified book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * Get the languages in which the book is available.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable')->withPivot('is_primary');
    }

    /**
     * Get the language in which the book was originally written.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function nativeLanguage()
    {

        return $this
            ->morphToMany(Language::class, 'languageable')
            ->wherePivot('is_primary', true);
    }

    /**
     * Get the likes of the specified book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', true);
    }

    /**
     * Get the dislikes of the specified book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function dislikes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', false);
    }

    /**
     * Clean the title attribute before updating it.
     *
     * @param $val
     */
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
