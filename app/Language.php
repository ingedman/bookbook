<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    /**
     * Get all books in the specified language
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function books()
    {
        return $this->morphedByMany(Book::class, 'languageable');
    }

    /**
     * Get all users with the specified language
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'languageable');
    }

    /**
     * Get all books in the specified language
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function reviews()
    {
        return $this->morphedByMany(Review::class, 'languageable');
    }
}
