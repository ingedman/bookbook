<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['content','reporter_id'];

    /**
     * Get the model that was reported on.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reportable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that added the report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
