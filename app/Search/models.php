<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;

class models extends Aggregator
{
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        \App\Review::class,
        \App\User::class,
        \App\Book::class,
    ];
}
