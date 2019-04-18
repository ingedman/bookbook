<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use Sluggable;
    protected $cast = [
        'is_flagged'=>'boolean',
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

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function poster(){
        return $this->belongsTo(User::class,'poster_id');
    }

    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }
    public function languages(){
        return $this->morphToMany(Language::class, 'languageable');
    }
    public function nativeLanguage(){

        return $this
            ->morphToMany(Language::class, 'languageable')
            ->withPivot('is_primary')
            ->where('is_primary',true);
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
