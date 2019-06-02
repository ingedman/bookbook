<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Author extends Model
{
    use Searchable;

    /**
     * Get the books written by the specified author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Get the reports on the specified author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * @param $val
     */
    public function setNameAttribute($val)
    {
        $this->attributes['name'] = trim($val);
    }

    /**
     * get json object to use in vue card controls component
     *
     * @return false|string
     */
    public function getControlsJsonAttribute()
    {
        $controlsJson = [];

        // urls
        $controlsJson['url'] = route('author', $this->{'id'});
        $controlsJson['reportUrl'] = route('author.report', $this->{'id'});
        return json_encode($controlsJson);
    }
}
