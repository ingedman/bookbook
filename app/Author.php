<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books(){
        return $this->belongsToMany(Book::class);
    }
    public function reports(){
        return $this->morphMany(Report::class, 'reportable');
    }
    public function setNameAttribute($val){
        $this->attributes['name'] = trim($val);
    }
}
