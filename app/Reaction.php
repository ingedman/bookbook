<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{

    protected $fillable = [
        'user_id', 'is_like',
    ];

    protected $cast = [
      'is_like'=>'boolean',
    ];

    public function reactionable()
    {
        return $this->morphTo();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
