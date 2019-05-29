<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Author extends Model
{
    use Searchable;

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function setNameAttribute($val)
    {
        $this->attributes['name'] = trim($val);
    }

    public function getControlsJsonAttribute()
    {
        $controlsJson = [];

        // urls
        $controlsJson['url'] = route('author', $this->{'id'});
        $controlsJson['reportUrl'] = route('author.report', $this->{'id'});
        return json_encode($controlsJson);
    }
}
