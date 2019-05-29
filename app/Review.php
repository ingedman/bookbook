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

    public function likes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', true);
    }

    public function dislikes()
    {
        return $this->morphMany(Reaction::class, 'reactionable')->where('is_like', '=', false);
    }

    public function getCommentsCountAttribute()
    {
        $comments = $this->comments()->withCount('replies')->get();
        if (count($comments) > 0) {
            return $comments->reduce(function ($carry, $item) {
                return $carry + $item->replies_count + 1;
            });
        } else {
            return 0;
        }
    }

    public function getControlsJsonAttribute()
    {

        $controlsJson = [];

        $controlsJson['likes']['count'] = $this->{'likes'}->count();
        $controlsJson['likes']['already'] = $this->{'likes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });
        $controlsJson['dislikes']['count'] = $this->{'dislikes'}->count();
        $controlsJson['dislikes']['already'] = $this->{'dislikes'}->contains(function ($like) {
            return $like->user_id == \Auth::user()->{'id'};
        });
        $controlsJson['comments']['count'] = $this->{'commentsCount'};
        $controlsJson['bookmarked'] = \Auth::user()->{'readList'}->contains($this);

        // urls
        $controlsJson['url'] = route('review', $this->{'slug'});
        $controlsJson['comments_url'] = route('review', $this->{'slug'}).'#comments';
        $controlsJson['likeUrl'] = route('review.like', $this->{'id'});
        $controlsJson['dislikeUrl'] = route('review.dislike', $this->{'id'});
        $controlsJson['reportUrl'] = route('review.report', $this->{'id'});
        $controlsJson['bookmarkUrl'] = route('review.bookmark', $this->{'id'});

        return json_encode($controlsJson);
    }



    public function setTitleAttribute($val)
    {
        $this->attributes['title'] = trim($val);
    }
    public function getPureContentAttribute()
    {

        return Purify::clean($this->{'content'});
    }

    public function getPreviewAttribute()
    {
        $text = '';
        $limit = 200;
        $parserItems = HTMLDomParser::str_get_html($this->{'pureContent'})->find('*');

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
}
