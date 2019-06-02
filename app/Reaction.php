<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'is_like',
    ];

    /**
     * @var array
     */
    protected $cast = [
      'is_like'=>'boolean',
    ];

    /**
     * Get the reactionable model associated with the specified reaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reactionable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user added the reaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
