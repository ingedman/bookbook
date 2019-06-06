<?php

namespace App;

use App\Contracts\Reportable;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;
use Sunra\PhpSimple\HtmlDomParser;

class Review extends Model
{
    use Sluggable;
    use Searchable;

    protected $fillable = [
        'title', 'content','reviewer_id', 'language_id','book_id'
    ];

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
     * Get the book the was reviewed by a review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the reviewer of a review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Get the comments of a review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    /**
     * get the language of a review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the reports of a review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    /**
     * get the likes of a review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', true);
    }

    /**
     * get the dislikes of a review
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function dislikes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', false);
    }

//    /**
//     * Get the total number of comment of a review.
//     *
//     * @return int|mixed
//     */
//    public function getCommentsCountAttribute()
//    {
//        $comments = $this->comments()->withCount('replies')->get();
//        if (count($comments) > 0) {
//            return $comments->reduce(function ($carry, $item) {
//                return $carry + $item->replies_count + 1;
//            });
//        } else {
//            return 0;
//        }
//    }

    /**
     * get json object to use in vue card controls component
     *
     * @return false|string
     */
    public function getControlsJsonAttribute()
    {
        $this->loadCount(['likes','dislikes','comments']);

        $controlsJson = [];

        // reactions info
        $controlsJson['likes']['count'] = $this->{'likes_count'};
        $controlsJson['likes']['already'] = $this->{'likes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });
        $controlsJson['dislikes']['count'] = $this->{'dislikes_count'};
        $controlsJson['dislikes']['already'] = $this->{'dislikes'}->contains(function ($dislike) {
            return $dislike->user_id == \Auth::user()->{'id'};
        });

        $controlsJson['comments']['count'] = $this->{'comments_count'};
        $controlsJson['bookmarked'] = \Auth::user()->{'readList'}->contains($this);

        // urls
        $controlsJson['url'] = route('review', $this->{'slug'});
        $controlsJson['editUrl'] = route('review.edit', $this->{'slug'});
        $controlsJson['comments_url'] = route('review', $this->{'slug'}).'#comments';
        $controlsJson['likeUrl'] = route('review.like', $this->{'id'});
        $controlsJson['dislikeUrl'] = route('review.dislike', $this->{'id'});
        $controlsJson['reportUrl'] = route('review.report', $this->{'id'});
        $controlsJson['bookmarkUrl'] = route('review.bookmark', $this->{'id'});

        return json_encode($controlsJson);
    }


    /**
     * set the title of review.
     *
     * @param $val
     */
    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = trim($val);
    }

    /**
     * get cleaned html content from the review.
     *
     * @return mixed
     */
    public function getPureContentAttribute()
    {

        return Purify::clean($this->{'content'});
    }


    /**
     * Get a preview of the content of review after removing html tags
     *
     * @return string
     */
    public function getPreviewAttribute()
    {
        $text = '';
        $limit = 200;


        $parserItems = HTMLDomParser::str_get_html($this->{'pureContent'})->find('*');
        return \Str::limit($this->{'pureContent'} , $limit);

        foreach ($parserItems as $htmlItem){
            $text = $text . \Str::limit($htmlItem->plaintext , $limit - strlen($text)) . '<br>';
            if(strlen($text) > $limit){
                break;
            }
        }
        if (empty($parserItems)){
            $text = \Str::limit($this->{'pureContent'} , $limit);
        }
        return $text;
    }
    /**
     * Splits the given value.
     *
     * @param  string $value
     * @return array
     */
    public function splitContent($value)
    {
        return explode('. ', $value);
    }
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

//        dd($array);
        // Applies Scout Extended default transformations:
        $array = $this->transform($array);


        return $array;
    }
}
