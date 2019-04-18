<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    public function books()
    {
        return $this->morphedByMany(Book::class, 'languageable');
    }
    public function users()
    {
        return $this->morphedByMany(User::class, 'languageable');
    }
    public function reviews()
    {
        return $this->morphedByMany(Review::class, 'languageable');
    }
}
